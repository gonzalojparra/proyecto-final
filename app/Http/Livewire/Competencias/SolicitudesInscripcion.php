<?php

namespace App\Http\Livewire\Competencias;

use App\Mail\EnvioMail;
use App\Models\User;
use App\Models\CompetenciaCompetidor;
use App\Models\Pasada;
use App\Models\Graduacion;
use App\Models\PasadaJuez;
use App\Models\CompetenciaJuez;
use App\Models\Competencia;
use App\Models\Poomsae;
use App\Models\CompetenciaCategoria;
use App\Models\PoomsaeCompetenciaCategoria;
use App\Models\Actualizacion;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SolicitudesInscripcion extends Component
{

    protected $inscriptos;
    public $idCompetencia = null;
    public $filtro;
    public $filtroRol;
    public $escuelaNueva = false;
    public $graduacionNueva = false;
    public $galNuevo = false;

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $competencia = Competencia::find($this->idCompetencia);
        $inscriptosPendientes = array();
        if ($competencia != null) {
            $inscriptosCompetidor = CompetenciaCompetidor::get();
            $inscriptosJuez = CompetenciaJuez::get();
            $cant = count($inscriptosCompetidor) + count($inscriptosJuez);
            if ($cant > 0) {
                // Guardamos las peticiones de los competidores
                foreach ($inscriptosCompetidor as $inscripto) {
                    if ($inscripto->id_competencia == $this->idCompetencia && $inscripto->aprobado == 0) {
                        $peticionModificacion = Actualizacion::where('id_user', $inscripto->id_competidor)->first();
                        if ($peticionModificacion) {
                            $inscripto->actualizacion = $peticionModificacion;
                        }
                        $inscripto->rol = 'Competidor';
                        $inscriptosPendientes[] = $inscripto;
                    }
                }
                // Guardamos las peticiones de los jueces
                foreach ($inscriptosJuez as $inscripto) {
                    if ($inscripto->id_competencia == $this->idCompetencia && $inscripto->aprobado == 0) {
                        $peticionModificacion = Actualizacion::where('id_user', $inscripto->id_juez)->first();
                        if ($peticionModificacion) {
                            // dd($peticionModificacion);
                            $inscripto->actualizacion = $peticionModificacion;
                            // dd($inscripto->actualizacion->id_escuela_nueva);
                        }
                        $inscripto->rol = 'Juez';
                        $inscriptosPendientes[] = $inscripto;
                    }
                }
            }
        }

        $competidores = CompetenciaCompetidor::where('id_competencia', $this->idCompetencia)->where('aprobado', 1)->get();
        $jueces = CompetenciaJuez::where('id_competencia', $this->idCompetencia)->where('aprobado', 1)->get();

        return view('livewire.competencias.solicitudes-inscriptos', ['competencia' => $competencia, 'inscriptosPendientes' => $inscriptosPendientes, 'competidores' => $competidores, 'jueces' => $jueces]);
    }

    public function mostrarSolicitud($id)
    {
        $this->emit('mostrarCambioSilicitado', $id);
    }

    // Con esta funcion 'Mount' recibimos los datos enviados desde la URL
    public function mount($idCompetencia)
    {
        $this->idCompetencia = $idCompetencia;
    }




    public function crearPasadaCompetidor($idCompetidor)
    {
        $idCompetencia = $this->idCompetencia;

        $competidor = CompetenciaCompetidor::where('id_competidor', $idCompetidor)
            ->where('id_competencia', $idCompetencia)
            ->first();
            
            // dd($competidor->id);
            // $poomsaeEleccion = Poomsae::latest('id')->first();
            // dd($competidor->id == 6);
            // dd($competidor->id_categoria);
            // dd( $poomsaeAsignado = Poomsae::where('nombre', 'like', '%SAH CHANG%')->first());

            // dd( $poomsaeRandom = Poomsae::inRandomOrder()->first());
    //         $poomsaeCategoria = PoomsaeCompetenciaCategoria::where('id_competencia_categoria', $competidor->id_categoria)
    // ->where('id_graduacion', $competidor->user->id_graduacion)
    // ->first();
    //         dd($poomsaeCategoria->id_poomsae2);
        
        if (!$competidor) {
            throw new \Exception('Competidor no encontrado.');
        }

        // Verificar si el competidor pertenece a la categoría "Precompetitivos"
        if ($competidor->id_categoria == 1) {
            // Asignar el ultimo Poomsae de la bd donde dice que es a a elección
            $poomsaeEleccion = Poomsae::latest('id')->first();

            Pasada::create([
                'ronda' => 1,
                'id_poomsae' => $poomsaeEleccion->id,
                'id_competidor' => $idCompetidor,
                'id_competencia' => $idCompetencia,
            ]);

    
            Pasada::create([
                'ronda' => 2,
                'id_poomsae' => $poomsaeEleccion->id,
                'id_competidor' => $idCompetidor,
                'id_competencia' => $idCompetencia,
            ]);

        } 
        else if ($competidor->id_categoria == 4 || $competidor->id_categoria == 5 || $competidor->id_categoria == 6 || $competidor->id_categoria == 7) {
            // Asignar el poomsae correspondiente según la regla para la categoría "Juvenil" y superiores
           
            if ($competidor->id_categoria == 4) {
                $poomsaeAsignado = Poomsae::where('nombre', 'like', '%SAH CHANG%')->first();
            } elseif ($competidor->id_categoria == 5) {
                $poomsaeAsignado = Poomsae::where('nombre', 'like', '%PYONKWONG%')->first();
            } elseif ($competidor->id_categoria == 6) {
                $poomsaeAsignado = Poomsae::where('nombre', 'like', '%SIPJIN%')->first();
            } else {
                $poomsaeAsignado = Poomsae::where('nombre', 'like', '%HANSU%')->first();
            }

            Pasada::create([
                'ronda' => 1,
                'id_poomsae' => $poomsaeAsignado->id,
                'id_competidor' => $idCompetidor,
                'id_competencia' => $idCompetencia,
            ]);

            // Para la segunda pasada, asignamos el poomsae aleatorio como antes
            $poomsaeRandom = PoomsaeCompetenciaCategoria::where('id_competencia_categoria', $competidor->id_categoria)
                ->where('id_graduacion', $competidor->user->id_graduacion)
                ->first();

            $idPoomsaeRandom =  $poomsaeRandom->id_poomsae2;

            Pasada::create([
                'ronda' => 2,
                'id_poomsae' => $idPoomsaeRandom,
                'id_competidor' => $idCompetidor,
                'id_competencia' => $idCompetencia,
            ]);
        } 
        else{
            // Para categorías inferiores a "Juveniles", seguimos asignando poomsaes aleatorios como antes
            $poomsaeCategoria = PoomsaeCompetenciaCategoria::where('id_competencia_categoria', $competidor->id_categoria)
                ->where('id_graduacion', $competidor->user->id_graduacion)
                ->first();

            if (!$poomsaeCategoria) {
                throw new \Exception('Poomsae no encontrado para la graduación y categoría del competidor.');
            }

            $idPoomsae1 = $poomsaeCategoria->id_poomsae1;
            $idPoomsae2 = $poomsaeCategoria->id_poomsae2;

            Pasada::create([
                'ronda' => 1,
                'id_poomsae' => $idPoomsae1,
                'id_competidor' => $idCompetidor,
                'id_competencia' => $idCompetencia,
            ]);

            Pasada::create([
                'ronda' => 2,
                'id_poomsae' => $idPoomsae2,
                'id_competidor' => $idCompetidor,
                'id_competencia' => $idCompetencia,
            ]);
        }
    }



    public function aceptar($rol, $id, $actualizacion = null)
    {
        $usuario = Auth::user();
        
        /* $participante = CompetenciaJuez::find($id); */
        if ($rol == "Competidor") {
            $participante = CompetenciaCompetidor::find($id);
            $this->crearPasadaCompetidor($participante->id_competidor);
        } else {
            $participante = CompetenciaJuez::find($id);
        }
        // Si envio una solicitud de modificacion, modificamos.
        if ($actualizacion != null) {
            if ($actualizacion['id_escuela_nueva'] != null) {
                $participante->user->id_escuela = $actualizacion['id_escuela_nueva'];
            }
            if ($actualizacion['id_graduacion_nueva'] != null) {
                $participante->user->id_graduacion = $actualizacion['id_graduacion_nueva'];
            }
            if ($actualizacion['gal_nuevo']) {
                $participante->user->gal =  $actualizacion['gal_nuevo'];
            }
            Actualizacion::where('id_user', $actualizacion['id_user'])->delete();
        }
        $participante->aprobado = 1;
        $participante->user->save();
        $participante->save();
        Mail::to($participante->user->email)->send(new EnvioMail($participante->user->id, 3, $participante->id_competencia));
    }

    public function rechazar($rol, $id, $idCompetencia, $actualizacion = null)
    {
        if ($rol == "Competidor") {
            $participante = CompetenciaCompetidor::find($id);
        } else {
            $participante = CompetenciaJuez::find($id);
        }

        if ($actualizacion != null) {
            Actualizacion::where('id_user', $actualizacion['id_user'])->delete();
        }

        Mail::to($participante->user->email)->send(new EnvioMail($participante->user->id, 4, $idCompetencia));
        $participante->delete();
    }

    public function eliminarJuez($id)
    {
        CompetenciaJuez::find($id)->delete();
    }

    public function eliminarCompetidor($id)
    {
        CompetenciaCompetidor::find($id)->delete();
    }
}

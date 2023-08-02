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



    // public function crearPasadaCompetidor($idCompetidor)
    // {
    //     $idCompetencia = $this->idCompetencia;

    //     $competidor = CompetenciaCompetidor::where('id_competidor', $idCompetidor)
    //         ->where('id_competencia', $idCompetencia)
    //         ->first();

    //     if (!$competidor) {
    //         throw new \Exception('Competidor no encontrado.');
    //     }

    //     // Categoría "Precompetitivos": Ambas pasadas deben ser a elección
    //     if ($competidor->id_categoria == 1) {
    //         $poomsaeEleccion = Poomsae::where('nombre', 'A elección')->get();

    //         Pasada::create([
    //             'ronda' => 1,
    //             'id_poomsae' => $poomsaeEleccion->id,
    //             'id_competidor' => $idCompetidor,
    //             'id_competencia' => $idCompetencia,
    //         ]);

    //         Pasada::create([
    //             'ronda' => 2,
    //             'id_poomsae' => $poomsaeEleccion->id,
    //             'id_competidor' => $idCompetidor,
    //             'id_competencia' => $idCompetencia,
    //         ]);
    //     } else if ($competidor->id_categoria == 4 || $competidor->id_categoria == 5 || $competidor->id_categoria == 6 || $competidor->id_categoria == 7) {
    //         // Categorías "Juveniles", "Senior 1", "Senior 2" y "Master 1": Segunda pasada según las reglas de sorteo

    //         // Obtener los poomsaes disponibles para la segunda pasada según la categoría del competidor
    //         if ($competidor->id_categoria == 4) {
    //             $poomsaesDisponibles = Poomsae::where('nombre', 'like', '%SA CHANG%')->get();
    //         } 
    //         if ($competidor->id_categoria == 5) {
    //             $poomsaesDisponibles = Poomsae::where('nombre', 'like', '%PYONKWONG%')->get();
    //         } 
    //         if ($competidor->id_categoria == 6) {
    //             $poomsaesDisponibles = Poomsae::where('nombre', 'like', '%PYONKWONG%')->get();
    //         } 

    //         // Seleccionar un poomsae aleatorio de la lista de poomsaes disponibles para la primera pasada
    //         $poomsaePrimeraPasada = $poomsaesDisponibles->random();

    //         Pasada::create([
    //             'ronda' => 1,
    //             'id_poomsae' => $poomsaePrimeraPasada->id,
    //             'id_competidor' => $idCompetidor,
    //             'id_competencia' => $idCompetencia,
    //         ]);

    //         // Para la segunda pasada, asegurarnos de que cumpla con las reglas también
    //         // Excluir el poomsae de la primera pasada de la lista de disponibles
    //         $poomsaesSegundaPasada = $poomsaesDisponibles->whereNotIn('id', [$poomsaePrimeraPasada->id]);

    //         // Seleccionar un poomsae aleatorio de la lista restante para la segunda pasada
    //         $poomsaeSegundaPasada = $poomsaesSegundaPasada->random();

    //         Pasada::create([
    //             'ronda' => 2,
    //             'id_poomsae' => $poomsaeSegundaPasada->id,
    //             'id_competidor' => $idCompetidor,
    //             'id_competencia' => $idCompetencia,
    //         ]);
    //     } else {
    //         // Otras categorías: Segunda pasada según las reglas de sorteo para cada graduación y categoría

    //         $poomsaeCategoria = PoomsaeCompetenciaCategoria::where('id_competencia_categoria', $competidor->id_categoria)
    //             ->where('id_graduacion', $competidor->user->id_graduacion)
    //             ->first();

    //         if (!$poomsaeCategoria) {
    //             throw new \Exception('Poomsae no encontrado para la graduación y categoría del competidor.');
    //         }

    //         $idPoomsae1 = $poomsaeCategoria->id_poomsae1;
    //         $idPoomsae2 = $poomsaeCategoria->id_poomsae2;

    //         Pasada::create([
    //             'ronda' => 1,
    //             'id_poomsae' => $idPoomsae1,
    //             'id_competidor' => $idCompetidor,
    //             'id_competencia' => $idCompetencia,
    //         ]);

    //         Pasada::create([
    //             'ronda' => 2,
    //             'id_poomsae' => $idPoomsae2,
    //             'id_competidor' => $idCompetidor,
    //             'id_competencia' => $idCompetencia,
    //         ]);
    //     }
    // }

    // Función para asignar los poomsaes a los competidores
    public function asignarPasadaCompetidor($idCompetidor)
    {
        $idCompetencia = $this->idCompetencia;


        $competidor = CompetenciaCompetidor::where('id_competidor', $idCompetidor)
            ->where('id_competencia', $idCompetencia)
            ->first();


        if (!$competidor) {
            throw new \Exception('Competidor no encontrado.');
        }


        //  dd($competidor->id_categoria);
        // Verificar si el competidor pertenece a la categoría "Precompetitivos"
        if ($competidor->id_categoria == 1) {
            // Asignar un Poomsae a elección
            $poomsaeEleccion = Poomsae::where('nombre', 'A elección')->first();


            Pasada::create([
                'ronda' => 1,
                'id_poomsae' => $poomsaeEleccion->id,
                'id_competidor' => $idCompetidor,
                'id_competencia' => $idCompetencia,
            ]);


            // Para la segunda pasada, asignamos otro Poomsae a elección
            $poomsaeRandom = Poomsae::where('nombre', 'A elección')->inRandomOrder()->first();


            Pasada::create([
                'ronda' => 2,
                'id_poomsae' => $poomsaeRandom->id,
                'id_competidor' => $idCompetidor,
                'id_competencia' => $idCompetencia,
            ]);
        } else if ($competidor->id_categoria == 4 || $competidor->id_categoria == 5 || $competidor->id_categoria == 6 || $competidor->id_categoria == 7) {
            // Asignar el poomsae correspondiente según la regla para la categoría "Juvenil" y superiores
            // Por ejemplo, para "Juveniles" asignamos 'SA CHANG' y para "Senior 1" asignamos 'PYONKWONG'
            $poomsaeJuveniles = Poomsae::where('nombre', 'like', '%SA CHANG%')->first();
            $poomsaeSenior1 = Poomsae::where('nombre', 'like', '%PYONKWONG%')->first();


            if ($competidor->id_categoria == 4) {
                $poomsaeAsignado = $poomsaeJuveniles->id;
            } else {
                $poomsaeAsignado = $poomsaeSenior1->id;
            }


            Pasada::create([
                'ronda' => 1,
                'id_poomsae' => $poomsaeAsignado,
                'id_competidor' => $idCompetidor,
                'id_competencia' => $idCompetencia,
            ]);


            // Para la segunda pasada, asignamos el poomsae aleatorio como antes
            $poomsaeRandom = Poomsae::inRandomOrder()->first();


            Pasada::create([
                'ronda' => 2,
                'id_poomsae' => $poomsaeRandom->id,
                'id_competidor' => $idCompetidor,
                'id_competencia' => $idCompetencia,
            ]);
        } else {
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

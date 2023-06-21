<?php

namespace App\Http\Livewire\Competencias;

use App\Mail\EnvioMail;
use App\Models\User;
use App\Models\CompetenciaCompetidor;
use App\Models\Pasada;
use App\Models\PasadaJuez;
use App\Models\CompetenciaJuez;
use App\Models\Competencia;
use App\Models\CompetenciaCategoria;
use App\Models\PoomsaeCompetenciaCategoria;
use App\Models\Actualizacion;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SolicitudesInscripcion extends Component {

    protected $inscriptos;
    public $idCompetencia = null;
    public $filtro;
    public $filtroRol;

    protected $listeners = ['render'=>'render'];

    public function render() {
        $competencia = Competencia::find($this->idCompetencia);
        $inscriptosPendientes = array();
        if ($competencia != null){
            $inscriptosCompetidor = CompetenciaCompetidor::get();
            $inscriptosJuez = CompetenciaJuez::get();
            $cant = count($inscriptosCompetidor) + count($inscriptosJuez);
            if ($cant > 0){
                // Guardamos las peticiones de los competidores
                foreach ($inscriptosCompetidor as $inscripto) {
                    if ($inscripto->id_competencia == $this->idCompetencia && $inscripto->aprobado == false){
                        $peticionModificacion = Actualizacion::where('id_user', $inscripto->id_competidor)->first();
                        if ($peticionModificacion){
                            $inscripto->actualizacion = $peticionModificacion;
                        }
                        $inscripto->rol = 'Competidor';
                        $inscriptosPendientes[] = $inscripto;
                    }
                }
                // Guardamos las peticiones de los jueces
                foreach ($inscriptosJuez as $inscripto) {
                    if ($inscripto->id_competencia == $this->idCompetencia && $inscripto->aprobado == false){
                        $peticionModificacion = Actualizacion::where('id_user', $inscripto->id_juez)->get();
                        if (count($peticionModificacion) > 0){
                            $inscripto->actualizacion = $peticionModificacion;
                        }
                        $inscripto->rol = 'Juez';
                        $inscriptosPendientes[] = $inscripto;
                    }
                }
            }
        }

        $competidores = CompetenciaCompetidor::where('id_competencia', $this->idCompetencia)->where('aprobado', true)->get();
        $jueces = CompetenciaJuez::where('id_competencia', $this->idCompetencia)->where('aprobado', true)->get();

        return view('livewire.competencias.solicitudes-inscriptos', ['competencia' => $competencia, 'inscriptosPendientes' => $inscriptosPendientes, 'competidores' => $competidores, 'jueces' => $jueces]);
    }

    public function mostrarSolicitud($id){
        $this->emit('mostrarCambioSilicitado',$id);
    }

    // Con esta funcion 'Mount' recibimos los datos enviados desde la URL
    public function mount($idCompetencia)
    {
        $this->idCompetencia = $idCompetencia;
    }

    public function crearPasadaCompetidor($idCompetidor){
        $idCompetencia = $this->idCompetencia;
        $competidor = CompetenciaCompetidor::where('id_competidor', $idCompetidor)->where('id_competencia', $idCompetencia)->first();
        // $categorias = CompetenciaCategoria::where('id_categoria', $competidor->id_categoria);
        $poomsae = PoomsaeCompetenciaCategoria::where('id_graduacion', $competidor->user->id_graduacion)
        ->where('id_competencia_categoria', $competidor->id_categoria)->first();
        // dd($poomsae);

        Pasada::create([
            'ronda' => 1,
            'id_poomsae' => $poomsae->id_poomsae1,
            'id_competidor' => $idCompetidor,
            'id_competencia' => $idCompetencia,
        ]);
        Pasada::create([
            'ronda' => 2,
            'id_poomsae' => $poomsae->id_poomsae2,
            'id_competidor' => $idCompetidor,
            'id_competencia' => $idCompetencia,
        ]);
    }

    public function aceptar($rol, $id, $actualizacion = null)
    {       
        if ($rol == "Competidor"){
            $participante = CompetenciaCompetidor::find($id);
            $this->crearPasadaCompetidor($participante->id_competidor);
        }else{
            $participante = CompetenciaJuez::find($id);
        }
        // Si envio una solicitud de modificacion, modificamos.
        if ($actualizacion != null){
            $participante->user->id_escuela = $actualizacion['id_escuela_nueva'];
            $participante->user->graduacion = $actualizacion['id_graduacion_nueva'];
            Actualizacion::where('id_user', $actualizacion['id_user'])->delete();
        }
        $participante->aprobado = true;
        $participante->user->save();
        $participante->save();
        Mail::to($participante->user->email)->send(new EnvioMail($participante->user->id,3));
    }

    public function rechazar($rol, $id, $idCompetencia)
    {
        if ($rol == "Competidor"){
            $participante = CompetenciaCompetidor::find($id);
        } else {
            $participante = CompetenciaJuez::find($id);
        }     
        Mail::to($participante->user->email)->send(new EnvioMail($participante->user->id,4,$idCompetencia));
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
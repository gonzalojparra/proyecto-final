<?php

namespace App\Http\Livewire\Competencias;

use App\Models\User;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaJuez;
use App\Models\Competencia;
use App\Models\Actualizacion;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


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
                        $peticionModificacion = Actualizacion::where('id_user', $inscripto->id_competidor);
                        if ($peticionModificacion->exists()){
                            $inscripto->actualizacion = $peticionModificacion;
                        }
                        $inscripto->rol = 'Competidor';
                        $inscriptosPendientes[] = $inscripto;
                    }
                }
                // Guardamos las peticiones de los jueces
                foreach ($inscriptosJuez as $inscripto) {
                    if ($inscripto->id_competencia == $this->idCompetencia && $inscripto->aprobado == false){
                        $peticionModificacion = Actualizacion::where('id_user', $inscripto->id_juez);
                        if ($peticionModificacion->exists()){
                            $inscripto->actualizacion = $peticionModificacion;
                        }
                        $inscripto->rol = 'Juez';
                        $inscriptosPendientes[] = $inscripto;
                    }
                }
            }
        }
        return view('livewire.competencias.solicitudes-inscriptos', ['inscriptosPendientes' => $inscriptosPendientes]);
    }

    // Con esta funcion 'Mount' recibimos los datos enviados desde la URL
    public function mount($idCompetencia)
    {
        $this->idCompetencia = $idCompetencia;
    }

    public function aceptar($id)
    {
        $competenciaCompetidor = CompetenciaCompetidor::find($id);
        $competenciaCompetidor->aprobado = true;
        $competenciaCompetidor->save();
    }

    public function rechazar($id)
    {
        CompetenciaCompetidor::find($id)->delete();
    }
}
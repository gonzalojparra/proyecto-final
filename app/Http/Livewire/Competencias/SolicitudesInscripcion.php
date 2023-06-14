<?php

namespace App\Http\Livewire\Competencias;

use App\Models\User;
use App\Models\CompetenciaCompetidor;
use App\Models\Competencia;
use App\Models\Actualizaciones;
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
            $inscriptos = CompetenciaCompetidor::get();
            if (count($inscriptos) > 0){
                foreach ($inscriptos as $inscripto) {
                    if ($inscripto['id_competencia'] == $this->idCompetencia && $inscripto['aprobado'] == false){
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
}
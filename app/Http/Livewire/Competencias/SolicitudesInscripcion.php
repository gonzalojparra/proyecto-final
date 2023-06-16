<?php

namespace App\Http\Livewire\Competencias;

use App\Models\User;
use App\Models\CompetenciaCompetidor;
use App\Models\Competencia;
use App\Models\Actualizaciones;
use App\Models\Team;
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
                        $competidor = User::where('id',$inscripto->id_competidor)->select('name','apellido','id_escuela','graduacion')->get();
                        $datos = [
                            'idCompetidor' => $inscripto->id_competidor,
                            'nombreCompetidor' => $competidor[0]->name. " ". $competidor[0]->apellido,
                            'escuela' => Team::where('id',$competidor[0]->id_escuela)->pluck('name')[0],
                            'graduacion'=>$competidor[0]->graduacion,
                            'tieneSolicitud' => (Actualizaciones::where('id_user',$inscripto->id_competidor)->count() > 0)? true : false
                        ];
                        array_push($inscriptosPendientes,$datos);
                        
                    }
                }
            }
        }
        return view('livewire.competencias.solicitudes-inscriptos', ['inscriptosPendientes' => $inscriptosPendientes]);
    }

    public function mostrarSolicitud($id){
        $this->emit('mostrarCambioSilicitado',$id);
    }

    // Con esta funcion 'Mount' recibimos los datos enviados desde la URL
    public function mount($idCompetencia)
    {
        $this->idCompetencia = $idCompetencia;
    }
}
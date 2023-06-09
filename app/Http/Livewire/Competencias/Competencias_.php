<?php

namespace App\Http\Livewire;

use App\Models\Competencia;
use Livewire\Component;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;


class _Competencias extends Component {

    protected $competencias = "";
    public $filtro;
    public $filtroFecha = "Todos";

    // protected $listeners = ['render'=>'render'];

    public function render() {
        $competencias = Competencia::where('titulo', 'like', '%' . $this->filtro . '%')->get();
        $fechaActual = date("Y-m-d");
        $competenciasPedidas = $competencias;

        if (isset($this->filtroFecha)){
            if ($this->filtroFecha == 'en-curso'){
                $competenciasPedidas = array();
                foreach ($competencias as $competencia) {
                    if ($competencia['fecha_inicio'] <= $fechaActual && $fechaActual <= $competencia['fecha_fin']){
                        $competenciasPedidas[] = $competencia;
                    }
                }
            } elseif ($this->filtroFecha == 'proximos'){
                $competenciasPedidas = array();
                foreach ($competencias as $competencia) {
                    if ($competencia['fecha_inicio'] > $fechaActual){
                        $competenciasPedidas[] = $competencia;
                    }
                }
            } elseif ($this->filtroFecha == 'finalizados'){
                $competenciasPedidas = array();
                foreach ($competencias as $competencia) {
                    if ($competencia['fecha_fin'] < $fechaActual){
                        $competenciasPedidas[] = $competencia;
                    }
                }
            }
        }

        return view('livewire.competencias.index', ['competencias' => $competenciasPedidas]);
    }
}
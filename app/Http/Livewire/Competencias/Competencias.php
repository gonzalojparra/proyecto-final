<?php

namespace App\Http\Livewire\Competencias;

use App\Models\Competencia;
use App\Models\CompetenciaCategoria;
use App\Models\PoomsaeCompetenciaCategoria;
use Livewire\Component;
use Livewire\WithFileUploads;


class Competencias extends Component {

    use WithFileUploads;

    protected $competencias;
    public $competencia;
    public $open = false;
    public $msj = null;
    public $filtro;// filtro de la tabla
    public $filtroFecha = 1;//filtro de la tabla por fecha
    public $titulo, $flyer, $bases, $descripcion, $fecha_inicio, $fecha_fin; //variables para el manejo de los datos del form


    protected $listeners = ['recarga'=>'render','msjAccion'=>'msjAccion'];


    public function render() {
        
        //metodo de renderizar la tabla de competencias
        $competencias = Competencia::where('titulo', 'like', '%' . $this->filtro . '%')->where('estado', '<>', 0)->where('estado', '<>', 5)->orderBy('estado', 'desc')->get();
        $competenciasPedidas = $competencias;
        $competenciasFinalizadas = Competencia::where('titulo', 'like', '%' . $this->filtro . '%')->where('estado', '=', 5)->orderBy('fecha_fin', 'desc')->get();

        return view('livewire.competencias.index', ['competencias' => $competenciasPedidas, 'competenciasFinalizadas' => $competenciasFinalizadas]);
    }

    public function agregarCompetencia() {
        $this->emit('abrirModal','agregar');

    }

    public function mostrarCompetencia($id) {
        $this->emit('mostrarDatos',[$id,'editar']);
    }

    public function delete($id) {
        $competencia = Competencia::find($id);
        $competencia->estado = 0;
        $competencia->save();
    }

    public function msjAccion($data){
        // dd($data);
        $this->msj[0] = $data[1];
        $this->msj[1] = $data[0];
        $this->emit('render');
    }

}
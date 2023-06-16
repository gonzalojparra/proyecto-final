<?php

namespace App\Http\Livewire\Competencias;

use App\Models\Competencia;
use App\Models\CompetenciaCategoria;
use Livewire\Component;
use Livewire\WithFileUploads;


class Competencias extends Component {

    use WithFileUploads;

    protected $competencias;
    public $competencia;
    public $open = false;
    public $msj;
    public $filtro;// filtro de la tabla
    public $filtroFecha = "Todos";//filtro de la tabla por fecha
    public $titulo, $flyer, $bases, $descripcion, $fecha_inicio, $fecha_fin; //variables para el manejo de los datos del form


    protected $listeners = ['recarga'=>'render','msjAccion'=>'msjAccion'];


    public function render() {
        
        //metodo de renderizar la tabla de competencias
        $competencias = Competencia::where('titulo', 'like', '%' . $this->filtro . '%')->get();
        
        $fechaActual = date("Y-m-d");
        $competenciasPedidas = $competencias;

        if (isset($this->filtroFecha)) {
            if ($this->filtroFecha == 'en-curso') {
                $competenciasPedidas = array();
                foreach ($competencias as $competencia) {
                    if ($competencia['fecha_inicio'] <= $fechaActual && $fechaActual <= $competencia['fecha_fin']){
                        $competenciasPedidas[] = $competencia;
                    }
                }
            } elseif ($this->filtroFecha == 'proximos') {
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

    public function agregarCompetencia() {
        $this->emit('abrirModal','agregar');

    }

    public function mostrarCompetencia($id) {
        $this->emit('mostrarDatos',[$id,'editar']);
    }

    public function verCompetencia($id) {
        return redirect()->route('competencias.ver-una-competencia', $id);
    }

    public function delete($id) {
        CompetenciaCategoria::where('id_competencia', $id)->delete();
        Competencia::destroy($id);
    }

    public function msjAccion($bool){
        $this->msj[0] = ($bool) ? "Cambio Realizado" : "Algo Salio Mal !!!";
        $this->msj[1] = $bool;
    }

}
<?php

namespace App\Http\Livewire\Categorias;

use App\Models\Categoria;
use App\Models\Graduacion;
use App\Models\User;
use Livewire\Component;


class Resultados extends Component {

    protected $categorias;
    public $msj;
    public $filtro; // filtro de la tabla


    protected $listeners = ['recarga'=>'render'];


    public function render() {
        
        //metodo de renderizar la tabla de competencias.
        $categorias = Categoria::get();
        $categoriasPedidas = Categoria::where('nombre', 'like', '%' . $this->filtro . '%')->get();

        $competidores = User::where('clasificacion', '<>', 0)->orderBy('clasificacion', 'desc')->get();
        $compGraduacion = [];
        foreach( $competidores as $competidor ){
            $graduacionQuery = Graduacion::where('id', $competidor->id_graduacion)->get();
            $array = $graduacionQuery->toArray();
            array_push($compGraduacion, $array);
        }

        // if (isset($this->filtroFecha)) {
        //     if ($this->filtroFecha == 'en-curso') {
        //         $competenciasPedidas = array();
        //         foreach ($competencias as $competencia) {
        //             if ($competencia['fecha_inicio'] <= $fechaActual && $fechaActual <= $competencia['fecha_fin']){
        //                 $competenciasPedidas[] = $competencia;
        //             }
        //         }
        //     } elseif ($this->filtroFecha == 'proximos') {
        //         $competenciasPedidas = array();
        //         foreach ($competencias as $competencia) {
        //             if ($competencia['fecha_inicio'] > $fechaActual){
        //                 $competenciasPedidas[] = $competencia;
        //             }
        //         }
        //     } elseif ($this->filtroFecha == 'finalizados'){ 
        //         $competenciasPedidas = array();
        //         foreach ($competencias as $competencia) {
        //             if ($competencia['fecha_fin'] < $fechaActual){
        //                 $competenciasPedidas[] = $competencia;
        //             }
        //         }
        //     }
        // }

        return view('livewire.categorias.resultados', ['categorias' => $categorias, 'categoriasPedidas' => $categoriasPedidas, 'competidores' => $competidores, 'compGraduacion' => $compGraduacion]);
    }
}
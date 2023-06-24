<?php

namespace App\Http\Livewire\Categorias;

use App\Models\Categoria;
use App\Models\Graduacion;
use App\Models\User;
use App\Models\Team;
use Livewire\Component;


class Resultados extends Component
{

    public $categorias;
    public $categoriaSeleccionada = 'Cadetes';
    public $categoriaPrevia = '';
    protected $compCategoria = [];
    public $msj;
    public $filtro; // filtro de la tabla
    public $graduacionSeleccionada = 'todas';
    public $graduacionesSelect = [];
    public $graduaciones;
    public $competidoresFiltrados = [];
    public $compGraduacion = [];
    public $competidores;
    public $podio = [];


    protected $listeners = ['recarga' => 'render'];


    public function render()
    {

        //metodo de renderizar la tabla de competencias.
        // $categorias = Categoria::get();
        // $categoriasPedidas = Categoria::where('nombre', 'like', '%' . $this->filtro . '%')->get();

        $this->competidores = User::where('id_graduacion', '<>', null)->where('verificado', 1)->orderBy('clasificacion', 'desc')->get();
        $this->obtenerCategorias();
        $this->obtenerGraduaciones();
        $this->filtrarCompetidores();
        $this->obtenerPodio();


        return view('livewire.categorias.resultados');
    }

    public function filtrarCompetidores()
    {
        $categoria =  Categoria::where('nombre', $this->categoriaSeleccionada)->get();
        $categoria = $categoria->toArray();
        // dd($categoria);
        $fechaActual = time();


        $compCategoria = array();
        foreach ($this->competidores as $competidor) {
            $fechaNac = strtotime($competidor->fecha_nac);
            $edad = round(($fechaActual - $fechaNac) / 31563000);
            if ($edad <= $categoria[0]['edad_hasta'] && $edad >= $categoria[0]['edad_desde'] && !in_array($competidor, $compCategoria)) {
                $unCompetidor = $competidor->toArray();
                array_push($compCategoria, $unCompetidor);
            }
        }

        if ($this->graduacionSeleccionada != 'todas') {
            $this->compGraduacion = [];
            $idGraduacion =  Graduacion::where('nombre', $this->graduacionSeleccionada)->pluck('id');
            foreach ($compCategoria as $competidor) {
                if ($idGraduacion[0] == $competidor['id_graduacion'] && !in_array($competidor, $this->compGraduacion)) {
                    array_push($this->compGraduacion, $competidor);
                }
            }
        } else {
            $this->compGraduacion = [];
            foreach ($compCategoria as $competidor) {
                array_push($this->compGraduacion, $competidor);
            }
        }
        $this->categoriaPrevia = $this->categoriaSeleccionada;
    }



    public function obtenerPodio()
    {
        $listaCompetidores = $this->compGraduacion;
        $podio = [];

        for ($i = 0; $i < 3; $i++) {
            $mejorCompetidor = null;
            $mejorCalificacion = -1;

            foreach ($listaCompetidores as $competidor) {
                if ($competidor['clasificacion'] > $mejorCalificacion && !in_array($competidor, $podio)) {
                    $mejorCompetidor = $competidor;
                    $mejorCalificacion = $competidor['clasificacion'];
                }
            }

            if ($mejorCompetidor !== null) {
                $podio[] = $mejorCompetidor;
            }
        }

        $this->podio = $podio;
    }

    public function obtenerGraduaciones()
    {
        $this->graduaciones = Graduacion::All();
        $this->graduaciones = $this->graduaciones->toArray();
    }


    public function obtenerCategorias()
    {
        $this->categorias = Categoria::All();
        $this->categorias = $this->categorias->toArray();
    }
}

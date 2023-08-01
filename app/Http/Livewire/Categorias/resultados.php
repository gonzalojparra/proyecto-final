<?php

namespace App\Http\Livewire\Categorias;

use App\Models\CompetenciaCompetidor;
use App\Models\Categoria;
use App\Models\Competencia;
use App\Models\CompetenciaCategoria;
use App\Models\Graduacion;
use App\Models\User;
use App\Models\Team;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class Resultados extends Component
{

    public $categorias;
    public $categoriaSeleccionada = 'Cadetes';
    public $categoriaPrevia = '';
    protected $compCategoria = [];
    public $msj;
    public $filtro; // filtro de la tabla
    public $graduacionSeleccionada = '10 GUP, Blanco';
    public $graduacionesSelect = [];
    public $graduaciones;
    public $competenciasEnCurso=[];
    public $competenciasFinalizadas=[];
    public $rankingSeleccionado='General (anual)';
    public $competidoresFiltrados = [];
    public $compGraduacion = [];
    public $competidores;
    public $podio = [];
    public $calificacionesCompetencia = [];
    public $tituloRanking;
    public $competenciaEnCurso = false;

    protected $listeners = ['recarga' => 'render'];


    public function render()
    {
        $this->obtenerCompetencias();
        if($this->rankingSeleccionado!='General (anual)'){
            $competencia = Competencia::where('id', $this->rankingSeleccionado)->first();
            $this->tituloRanking = $competencia['titulo'];
            if($competencia['estado']===4){
                $this->competenciaEnCurso = true;
            } else {
                $this->competenciaEnCurso = false;
            }
            $this->obtenerCompetidoresCompetencia();
        } else {
            $this->tituloRanking = $this->rankingSeleccionado;
            $this->competidores = User::where('id_graduacion', '<>', null)->where('verificado', 1)->orderBy('clasificacion', 'desc')->get();
        }
       
        $this->obtenerCategorias();
        $this->obtenerGraduaciones();
        $this->filtrarCompetidores($this->competidores);
        $this->obtenerPodio();
        return view('livewire.categorias.resultados');
    }

    public function filtrarCompetidores($listadoCompetidores)
    {
        $categoria =  Categoria::where('nombre', $this->categoriaSeleccionada)->first();
        if (!$categoria) {
            return;
        }

        $fechaActual = time();

        $compCategoria = array();
        foreach ($listadoCompetidores as $competidor) {
            $fechaNac = strtotime($competidor->fecha_nac);
            $edad = round(($fechaActual - $fechaNac) / 31563000);
            if ($edad <= $categoria['edad_hasta'] && $edad >= $categoria['edad_desde'] && !in_array($competidor, $compCategoria)) {
                array_push($compCategoria, $competidor);
            }
        }

        if ($this->graduacionSeleccionada != 'todas') {
            $this->compGraduacion = [];
            $idGraduacion =  Graduacion::where('nombre', $this->graduacionSeleccionada)->pluck('id');
            foreach ($compCategoria as $competidor) {
                if ($idGraduacion[0] == $competidor->id_graduacion && !in_array($competidor, $this->compGraduacion)) {
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
                $puntajeCompetidor = null;
                if($this->rankingSeleccionado != 'General (anual)'){
                    $puntajeCompetidor = $this->calificacionesCompetencia[$competidor->id];      
                } else {
                    $puntajeCompetidor = $competidor['clasificacion'];     
                }
                if ($puntajeCompetidor > $mejorCalificacion && !in_array($competidor, $podio)) {
                    $mejorCompetidor = $competidor;
                    $mejorCalificacion = $puntajeCompetidor;
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
        if($this->rankingSeleccionado != 'General (anual)'){
            $categorias = CompetenciaCategoria::where('id_competencia', $this->rankingSeleccionado)->get();
            $categorias = $categorias->toArray();
            $categoriasArray = [];
            foreach ($categorias as $categoria) {
                $categoriaCompetencia = Categoria::where('id', $categoria['id_categoria'])->first();
                array_push($categoriasArray, $categoriaCompetencia);
            }
            $this->categorias = $categoriasArray;
            $this->ordenarCategorias();
        } else {
            $this->categorias = Categoria::All();
            $this->categorias = $this->categorias->toArray();
        }

    }

    function ordenarCategorias()
    {
        $arrAux = array();
        foreach ($this->categorias as $cat=> $row)
        {
            $arrAux[$cat] = is_object($row) ? $arrAux[$cat] = $row->id : $row['id'];
            $arrAux[$cat] = strtolower($arrAux[$cat]);
        }
        array_multisort($arrAux, SORT_ASC, $this->categorias);
    }

    public function obtenerCompetencias()
    {
        $this->competenciasEnCurso =  Competencia::Where('estado', 4)->get();
        $this->competenciasEnCurso = $this->competenciasEnCurso->toArray();
        $this->competenciasFinalizadas = Competencia::Where('estado', 5)->get(); 
        $this->competenciasFinalizadas = $this->competenciasFinalizadas->toArray();
    }

    public function obtenerCompetidoresCompetencia(){
        $this->competidores = CompetenciaCompetidor::where ('id_competencia', $this->rankingSeleccionado)->orderBy('calificacion', 'desc')->get();
        $this->competidores = $this->competidores->toArray();
        $this->competidores = array_filter($this->competidores, function($competidor) {
            return $competidor['calificacion'] !== null;
        });
        $graduaciones = [];
        $competidores = [];
        foreach ($this->competidores as $competidor) {
            $user = User::where('id', $competidor['id_competidor'])->first();
            $this->calificacionesCompetencia[$competidor['id_competidor']] = $competidor['calificacion'];
            array_push($competidores, $user);
        }
        $this->competidores = $competidores;
    }

}

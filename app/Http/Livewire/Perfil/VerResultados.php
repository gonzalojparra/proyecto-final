<?php

namespace App\Http\Livewire\Perfil;

use App\Models\Competencia;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaJuez;
use App\Models\Pasada;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Symfony\Component\VarDumper\Exception\ThrowingCasterException;

class VerResultados extends Component
{
    public $open = false;
    public $openCompetidores = false;
    public $posicion;
    public $competidores;
    public $catParticipantes;
    public $vista = 1;
    public $resultados;
    public $inscripciones;
    public $competencias;
    public $user;

    protected $listeners = [
        'abrirHistorial',
        'abrirInscripciones'
    ];

    public function render()
    {
        $this->inscripciones = $this->distinguirUsuario();
        return view('livewire.perfil.ver-resultados');
    }

    public function mount()
    {
        $this->user = Auth::user();
    }

    private function distinguirUsuario()
    {
        $rol = $this->user->roles()->pluck('name');
        if ($rol[0] == 'Juez' && $rol[0] != 'Admin') {
            $cositas = ($this->vista == 2) ? $this->obtenerInscripcionesJuez($this->user->id) : $this->obtenerCompetenciasParticipadasJuez($this->user->id);
        }
        if ($rol[0] == 'Competidor' && $rol[0] != 'Admin') {
            $cositas = ($this->vista == 2) ? $this->obtenerInscripciones($this->user->id) : $this->obtenerCompetenciasParticipadas($this->user->id);
        }
        return $cositas;
    }


    public function abrirInscripciones()
    {
        $this->vista = 2;
        $this->open = true;
    }

    public function abrirHistorial()
    {
        $this->vista = 1;
        $this->open = true;
    }

    private function obtenerInscripciones($id)
    {
        return CompetenciaCompetidor::where('id_competidor', $id)
            ->join('competencias', 'competencia_competidor.id_competencia', 'competencias.id')
            ->select(
                'competencias.titulo as nombreCompetencia',
                'competencias.fecha_inicio',
                'competencia_competidor.id as idCompentecia',
                'competencia_competidor.aprobado as estado',
                'competencia_competidor.created_at as fecha_inscripcion'
            )
            ->where('competencias.estado', '<', 5)
            ->orderBy('competencia_competidor.id', 'asc')
            ->get();
    }

    private function obtenerCompetenciasParticipadas($id)
    {
        $cosa = CompetenciaCompetidor::join('competencias', 'competencia_competidor.id_competencia', 'competencias.id')
            ->join('categorias', 'categorias.id', 'competencia_competidor.id')
            ->join('users', 'competencia_competidor.id_competidor', 'users.id')
            ->join('graduaciones', 'graduaciones.id', 'users.id_graduacion')
            ->select(
                'competencias.titulo as nombreCompetencia',
                'competencias.id as idCompetencia',
                'competencia_competidor.aprobado as estado',
                'competencia_competidor.created_at as fecha_inscripcion',
                'categorias.nombre as nombreCategoria',
                'graduaciones.nombre as graduacion'
            )->where('competencias.estado', '=', 5)
            ->where('id_competidor', '=', $id)
            ->orderBy('competencia_competidor.id', 'asc')
            ->get();

        // $this->obtenerPosicion($cosa[0]->idCompetencia);
        // return $cosa;

        if ($cosa->count() > 0) {
            $this->obtenerPosicion($cosa[0]->idCompetencia);
        }
        
        return $cosa;
        
    }

    // private function obtenerPosicion($idCompetencia)
    // {
    //     $resultados = Pasada::where('id_competencia', $idCompetencia)
    //         ->join('users', 'users.id', 'pasadas.id_competidor')
    //         ->select(
    //             'users.name as nombre',
    //             'users.id',
    //             DB::raw('SUM(calificacion) as puntos')
    //         )
    //         ->groupBy('id_competidor')
    //         ->orderBy('puntos', 'desc')
    //         ->get();
    //     $this->catParticipantes = count($resultados);
    //     $i = 0;
    //     $bool = true;
    //     while ($bool && $i < count($resultados)) {
    //         if ($resultados[$i]->id === $this->user->id) {
    //             $bool = true;
    //             $this->posicion = $i + 1;
    //         }
    //         $i++;
    //     };
    // }
    private function obtenerPosicion($idCompetencia)
    {
        $resultados = Pasada::where('id_competencia', $idCompetencia)
            ->join('users', 'users.id', 'pasadas.id_competidor')
            ->select(
                'users.name as nombre',
                'users.id',
                DB::raw('SUM(calificacion) as puntos')
            )
            ->groupBy('users.name', 'users.id') //agrego el users.name en el grupo para la consulta asi evito errores 
            ->orderBy('puntos', 'desc')
            ->get();

        $this->catParticipantes = count($resultados);

        $i = 0;
        $bool = true;

        while ($bool && $i < count($resultados)) {
            if ($resultados[$i]->id === $this->user->id) {
                $bool = true;
                $this->posicion = $i + 1;
            }
            $i++;
        }
    }


    private function obtenerInscripcionesJuez($id)
    {
        return CompetenciaJuez::where('id_juez', $id)
            ->join('competencias', 'competencia_juez.id_competencia', 'competencias.id')
            ->select(
                'competencias.titulo as nombreCompetencia',
                'competencias.fecha_inicio',
                'competencia_juez.id as idCompentecia',
                'competencia_juez.aprobado as estado',
                'competencia_juez.created_at as fecha_inscripcion'
            )
            ->where('competencias.estado', '<', 5)
            ->orderBy('competencia_juez.id', 'asc')
            ->get();
    }

    private function obtenerCompetenciasParticipadasJuez($idJuez)
    {
        $cosas = CompetenciaJuez::join('competencias', 'competencias.id', '=', 'competencia_juez.id_competencia')
            ->select('competencias.id as idCompentecia', 'competencias.titulo as nombreCompetencia')
            ->where('id_juez', $idJuez)
            ->where('competencias.estado', '=', 5)
            ->get();

        return $cosas;
    }

    // public function mostrarCompetidoresPuntuados($idCompetencia)
    // {
    //     $competidores = Pasada::join('pasadas_juez', 'pasadas.id', 'pasadas_juez.id_pasada')
    //         ->join('users', 'users.id', 'pasadas.id_competidor')
    //         ->select(
    //             'users.name as nombre',
    //             DB::raw('SUM(pasadas_juez.puntaje_exactitud) as exactitud'),
    //             DB::raw('SUM(pasadas_juez.puntaje_presentacion) as presentacion')
    //         )
    //         ->where('pasadas_juez.id_juez', '=', $this->user->id)
    //         ->where('pasadas.id_competencia', '=', $idCompetencia)
    //         ->groupBy('pasadas.id_competidor')
    //         ->get();

    //        $this->competidores = $competidores;
    //        $this->openCompetidores=true;
    // }

    public function mostrarCompetidoresPuntuados($idCompetencia)
    {
        $competidores = Pasada::join('pasadas_juez', 'pasadas.id', 'pasadas_juez.id_pasada')
            ->join('users', 'users.id', 'pasadas.id_competidor')
            ->select(
                'users.name as nombre',
                DB::raw('SUM(pasadas_juez.puntaje_exactitud) as exactitud'),
                DB::raw('SUM(pasadas_juez.puntaje_presentacion) as presentacion')
            )
            ->where('pasadas_juez.id_juez', '=', $this->user->id)
            ->where('pasadas.id_competencia', '=', $idCompetencia)
            ->groupBy('pasadas.id_competidor', 'users.name') //aca se incluye el nombre en el grupo para evitar el error 
            ->get();

        $this->competidores = $competidores;
        $this->openCompetidores = true;
    }
}

<?php

namespace App\Http\Livewire\Perfil;

use App\Models\Categoria;
use App\Models\CompetenciaCategoria;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaJuez;
use App\Models\Pasada;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Database\Query\Builder;
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
    public $ronda = 1;
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
        $cosa = CompetenciaCompetidor::select(
            'competencias.id as idCompentecia',
            'competencias.titulo as nombreCompetencia',
            'competencias.id as idCompetencia',
            'competencia_competidor.created_at as fecha_inscripcion',
            'categorias.nombre as nombreCategoria',
            'graduaciones.nombre as graduacion'
        )
            ->join('competencias', 'competencia_competidor.id_competencia', '=', 'competencias.id')
            ->join('users', 'competencia_competidor.id_competidor', '=', 'users.id')
            ->join('categorias', 'categorias.id', '=', 'competencia_competidor.id_categoria')
            ->join('graduaciones', 'graduaciones.id', '=', 'users.id_graduacion')
            ->where('competencias.estado', '=', 5)
            ->where('competencia_competidor.id_competidor', '=', $id)
            ->get()->toArray();

        if (!empty($cosa)) {
            for ($i = 0; $i < count($cosa); $i++) {
                $cosa[$i]['posicion'] = $this->obtenerPosicion($cosa[$i]['idCompetencia']);
            }
        }

        return $cosa;
    }

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
                $posicion = $i + 1;
            }
            $i++;
        };
        return $posicion;
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


    public function detallesCompetenciaJuez($idCompetencia)
    {
        $this->ronda = (!$this->openCompetidores) ? 1 : $this->ronda;

        $datos = Pasada::join('pasadas_juez', 'pasadas.id', 'pasadas_juez.id_pasada')
            ->join('users', 'users.id', 'pasadas.id_competidor')
            ->join('poomsaes', 'poomsaes.id', 'pasadas.id_poomsae')
            ->select(
                'pasadas.id_competencia as idCompetencia',
                'pasadas.ronda as ronda',
                'pasadas_juez.puntaje_exactitud as exactitud',
                'pasadas_juez.puntaje_presentacion as presentacion',
                'poomsaes.nombre as nombrePoom',
                'users.name as nombre',
                DB::raw('(select Sum(pj.puntaje_presentacion) from pasadas_juez pj join pasadas pa on pa.id = pj.id_pasada where pa.id_competencia=' . $idCompetencia . ' and pj.id_juez=' . $this->user->id . ' and pa.id_competidor = users.id ) as puntos_pre'),
                DB::raw('(select Sum(pj.puntaje_exactitud) from pasadas_juez pj join pasadas pa on pa.id = pj.id_pasada where pa.id_competencia=' . $idCompetencia . ' and pj.id_juez=' . $this->user->id . ' and pa.id_competidor = users.id ) as puntos_ex'),
            )
            ->where('pasadas_juez.id_juez', '=', $this->user->id)
            ->where('pasadas.id_competencia', '=', $idCompetencia)
            ->where('pasadas.ronda', '=', $this->ronda)
            ->get();

        $this->competidores = $datos;
        $this->openCompetidores = true;
    }

    public function detallesCompetenciaCompetidor($idCompetencia)
    {
        $this->ronda = (!$this->openCompetidores) ? 1 : $this->ronda;

        $datos = Pasada::join('pasadas_juez', 'pasadas.id', 'pasadas_juez.id_pasada')
            ->join('users', 'users.id', 'pasadas_juez.id_juez')
            ->join('poomsaes', 'poomsaes.id', 'pasadas.id_poomsae')
            ->select(
                'pasadas.id_competencia as idCompetencia',
                'pasadas.calificacion as calificacion',
                'pasadas.ronda as ronda',
                'pasadas_juez.puntaje_exactitud as exactitud',
                'pasadas_juez.puntaje_presentacion as presentacion',
                'poomsaes.nombre as nombrePoom',
                'users.name as nombre',
                DB::raw('(SELECT SUM(p.calificacion) FROM pasadas p WHERE pasadas.id_competidor = p.id_competidor AND pasadas.id_competencia = p.id_competencia GROUP BY pasadas_juez.id_juez) as total')
            )
            ->where('pasadas.id_competidor', '=', $this->user->id)
            ->where('pasadas.id_competencia', '=', $idCompetencia)
            ->where('pasadas.ronda', '=', $this->ronda)
            ->get();

        dd($this->obtenerCategoria($idCompetencia));

        $this->competidores = $datos;
        $this->openCompetidores = true;
    }

    public function pasarRonda($idCompetencia)
    {
        $this->ronda = ($this->ronda == 1) ? 2 : 1;
        $this->user->roles()->pluck('name')[0] == 'Competidor' ? $this->detallesCompetenciaCompetidor($idCompetencia) : $this->detallesCompetenciaJuez($idCompetencia);
    }

    private function obtenerPodioAnual()
    {
        
    }

    private function obtenerCategoria($idCompetencia)
{
    $idCategoria = CompetenciaCategoria::join('competencias', 'competencias.id', 'competencia_categoria.id_competencia')
        ->join('categorias','categorias.id','competencia_categoria.id_categoria')
        ->select('competencia_categoria.id_categoria')
        ->whereRaw("
            (SELECT DATEDIFF(competencias.fecha_inicio, fecha_nac) / 365 
             FROM users 
             WHERE users.id = " . $this->user->id . ") BETWEEN categorias.edad_desde AND categorias.edad_hasta
        ")
        ->get();

    return $idCategoria;
}

}

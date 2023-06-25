<?php

namespace App\Http\Livewire\Perfil;

use App\Models\Competencia;
use App\Models\CompetenciaCompetidor;
use App\Models\Pasada;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VerResultados extends Component
{
    public $open = false;
    public $openResul = false;
    public $vista;
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
        $this->user = Auth::user()->id;
        $this->inscripciones = ($this->vista == 2) ? $this->obtenerInscripciones($this->user) : $this->obtenerCompetenciasParticipadas($this->user);
        return view('livewire.perfil.ver-resultados');
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

    public function traerResultado($id)
    {
        $this->openResul = true;
        $this->resultados = Pasada::where('id_competencia', $id)
            ->join('users', 'users.id', 'pasadas.id_competidor')
            ->join('teams', 'users.id_escuela','teams.id')
            ->select(
                'users.name as nombre',
                'users.id',
                'teams.name as escuela',
                DB::raw('SUM(calificacion) as puntos')
            )
            ->groupBy('id_competidor')
            ->orderBy('puntos', 'desc')
            ->get();
        //dd($resultado);
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
        return CompetenciaCompetidor::join('competencias', 'competencia_competidor.id_competencia', 'competencias.id')
            ->select(
                'competencias.titulo as nombreCompetencia',
                'competencias.id as idCompentecia',
                'competencia_competidor.aprobado as estado',
                'competencia_competidor.created_at as fecha_inscripcion'
            )->where('competencias.estado', '=', 5)
            ->where('id_competidor', '=', $id)
            ->orderBy('competencia_competidor.id', 'asc')
            ->get();
    }
}

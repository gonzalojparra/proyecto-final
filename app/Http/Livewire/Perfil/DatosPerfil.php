<?php

namespace App\Http\Livewire\Perfil;

use App\Models\CompetenciaCompetidor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DatosPerfil extends Component
{
    public $user;
    public $vista = 0;
    public $incripciones;
    public $competenciasFinalizadas;

    protected $listeners=[
        'verPerfil',
        'verInscripcion',
        'verCompetencias'
    ];

    public function render()
    {
        $this->user = Auth::user();
        $this->incripciones = $this->obtenerInscripciones($this->user->id);
        $this->competenciasFinalizadas = $this->obtenerCompetenciasParticipadas($this->user->id);
        return view('livewire.perfil.datos-perfil');
    }

    private function obtenerInscripciones($id)
    {
        return CompetenciaCompetidor::where('id_competidor', $id)
            ->join('competencias', 'competencia_competidor.id_competencia', 'competencias.id')
            ->select(
                'competencias.titulo as nombreCompetencia',
                'competencia_competidor.id as idCompentecia',
                'competencia_competidor.aprobado as estado',
                'competencia_competidor.created_at as fecha_inscripcion'
            )
            ->where('competencias.estado','<',5)
            ->orderBy('competencia_competidor.id','asc')
            ->get();
    }

    private function obtenerCompetenciasParticipadas($id)
    {
        return CompetenciaCompetidor::where('id_competidor', $id)
            ->join('competencias', 'competencia_competidor.id_competencia', 'competencias.id')
            ->select(
                'competencias.titulo as nombreCompetencia',
                'competencia_competidor.id as idCompentecia',
                'competencia_competidor.aprobado as estado',
                'competencia_competidor.created_at as fecha_inscripcion'
            )->where('competencias.estado','=',5)
            ->orderBy('competencia_competidor.id','asc')
            ->get();
    }


    public function verPerfil()
    {
        $this->vista = 0;
        $this->render();
    }

    public function verInscripcion()
    {
        $this->vista = 1;
        $this->render();
    }

    public function verCompetencias()
    {
        $this->vista = 2;
        $this->render();
    }
}

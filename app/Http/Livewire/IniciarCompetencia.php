<?php

namespace App\Http\Livewire;

use App\Models\Competencia;
use App\Models\CompetenciaCompetidor;
use App\Models\CompetenciaJuez;
use Livewire\Component;

class IniciarCompetencia extends Component
{
    public $competencias;
    public $nombreCompetencia;
    public $nombreCompetidor;
    public $nombreEscuela;
    public $jueces;
    public $competidores;


    public function render()
    {
       /*  $this->competencias = $this->traerDatosCompetencia(); */
        return view('livewire.iniciar-competencia');
    }

    private function traerDatosCompetencia()
    {
        $this->competencias = Competencia::where('fecha_inicio', date('Ymd'))->where('estado', 3)->get();
        $this->jueces = CompetenciaJuez::where('id_competencia', $this->competencias[0]->id)->get();
        
        $this->competidores = CompetenciaCompetidor::where('id_competencia', $this->competencias[0]->id)->orderBy('id')->get();
        dd($this->competidores);
    }
}

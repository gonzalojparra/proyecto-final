<?php

namespace App\Http\Livewire\Competencias;

use App\Models\Competencia;
use Livewire\Component;

class VerCompetencias extends Component {

    public function render() {
        $competencias = Competencia::where('estado', '<>', 0)->get();
        return view('livewire.competencias.ver-competencias', ['competencias' => $competencias]);
    }

}
<?php

namespace App\Http\Livewire\Competencias;

use App\Models\Competencia;
use Livewire\Component;

class VerCompetencias extends Component {

    public function render() {
        $competencias = Competencia::all();
        return view('livewire.competencias.ver-competencias', ['competencias' => $competencias]);
    }

}
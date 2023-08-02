<?php

namespace App\Http\Livewire;

use App\Models\Competencia;
use App\Models\Pasada;
use App\Models\Poomsae;
use App\Models\User;
use Livewire\Component;

class VistaPantallaGrande extends Component {
    public $resultados;
    public $idPasada;
    public $pasada;
    public $pasadas;
    public $competidor;
    public $poomsae;
    public $competencia;
    protected $listeners = ['mostrarResultados'];

    public function mount($idPasada) {
        $this->idPasada = $idPasada;
        // Se filtran las pasadas que ya tienen una calificación promediada
        $this->pasadas = Pasada::whereNotNull('calificacion')->get();
        $this->pasada = $this->getPasadaObject($idPasada);
        $this->competidor = $this->getCompetidorObject();
        $this->poomsae = $this->getPoomsaeObject();
        $this->competencia = $this->getCompetenciaObject();
    }

    public function render() {
        return view('livewire.vista-pantalla-grande');
    }

    public function mostrarResultados($resultados) {
        $this->resultados = $resultados;
    }

    public function getPasadaObject($idPasada) {
        $pasada = Pasada::find($idPasada);
        return $pasada;
    }

    public function getCompetidorObject() {
        $id_competidor = $this->pasada->id_competidor;
        $competidor = User::find($id_competidor);
        return $competidor;
    }

    public function getPoomsaeObject() {
        $id_poomsae = $this->pasada->id_poomsae;
        $poomsae = Poomsae::find($id_poomsae);
        return $poomsae;
    }

    public function getCompetenciaObject() {
        $idCompetencia = $this->pasada->id_competencia;
        $competencia = Competencia::find($idCompetencia);
        return $competencia;
    }

}
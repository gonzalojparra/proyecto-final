<?php

namespace App\Http\Livewire\Puntuador;

use Livewire\Component;
use App\Models\PasadaJuez;
use App\Events\PuntajeEnviado;


class Pulsador extends Component {

    public $puntajeExactitud = 10;
    public $puntajePresentacion = 10;

    public function render() {
        return view('livewire.puntuador.pulsador');
    }

    /* public function store() {
        PasadaJuez::where('id_juez', $juezId)
                ->where('id_pasada', $pasadaId)
                ->update([
                    'puntaje_exactitud' => $puntajeExactitud,
                    'puntaje_presentacion' => $puntajePresentacion
                ]);
        event(new PuntajeEnviado($pasadaId));
    } */

}
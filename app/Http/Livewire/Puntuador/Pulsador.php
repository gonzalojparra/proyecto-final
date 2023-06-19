<?php

namespace App\Http\Livewire\Puntuador;

use Livewire\Component;
use App\Models\PasadaJuez;
use App\Events\PuntajeEnviado;


class Pulsador extends Component
{

    //Cuando termina el timer, se habilita un boton para enviar la puntuacion de exactitud y pasar a evaluar presentacion
    public $puntajeExactitud;
    public $puntajePresentacion;
    public $puntaje = 10;
    public $boton = 'saltar competidor';
    public $tipoPuntuacion;

    public function render()
    {
        return view('livewire.puntuador.pulsador');
    }

    // public function deducirPuntaje($boton)
    // {
    //     if ($boton == 3) {
    //         if ($this->puntaje > 0.3) {
    //             $this->puntaje -= 0.3;
    //         }else if ($this->puntaje == 0.3){
    //             $this->puntaje = 0;
    //         }
    //     } else if ($boton == 1) {
    //         if ($this->puntaje >= 0.1) {
    //             $this->puntaje -= 0.1;
    //         } else if ($this->puntaje == 0.1){
    //             $this->puntaje = 0;
    //         }
    //     }
    // }

    //NO ANDA BIEN DEDUCIR PUNTOS D:

    public function deducirTres(){
        if ($this->puntaje >= 0.3) {
            $this->puntaje -= 0.3;
        } 
    }

    public function deducirUno(){
        if ($this->puntaje >= 0.1) {
            $this->puntaje -= 0.1;
        } 
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

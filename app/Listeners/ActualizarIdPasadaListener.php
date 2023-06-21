<?php

namespace App\Listeners;

use App\Events\EnviarPasada;
use App\Http\Livewire\Puntuador\Pulsador;
use Livewire\Component;

class ActualizarIdPasadaListener
{
    public function handle(EnviarPasada $event)
    {
        // $componente = app(Pulsador::class);
        // dd($componente);
        // $componente->idPasada = $event->idPasada;
    }
}
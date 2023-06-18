<?php

namespace App\Listeners;

use App\Events\PuntajeEnviado;
use App\Models\CompetenciaJuez;
use App\Models\Pasada;
use App\Models\PasadaJuez;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ValidarPuntajeListener implements ShouldQueue {
    /**
     * Create the event listener.
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     * Primero se puntúa exactitud, que es cuando corre el cronómetro
     * Y una vez que todos hayan puntuado exactitud, se puntúa presentación
     * @param PuntajeEnviado $event
     * @return void
     */
    public function handle(PuntajeEnviado $event): void {
        $pasadaId = $event->idPasada;
        $jueces = CompetenciaJuez::pluck('id')->toArray();

        /** 
         * Aca podria validarse que primero se mande el puntaje de exactitud
         * Y una vez que el puntaje de exactitud no sea nulo se puede realizar
         * la query de que el puntaje de presentación no sea nulo
        **/
        $puntajesCount = Pasada::where('id', $pasadaId)
            ->whereIn('id_competencia_juez', $jueces)
            ->whereNotNull('puntaje_exactitud')
            ->whereNotNull('puntaje_presentacion')
            ->count();

        $juecesCount = count($jueces);

        if( $puntajesCount == $juecesCount ) {
            // Todos los jueces enviaron sus puntajes
            // Se realiza la sumatoria de los puntajes y se redirige a vista final
            
        } else {
            // Aún faltan puntajes
            // Se espera a que todos los jueces envien sus puntajes, se mantiene en vista de espera
        }
    }

}
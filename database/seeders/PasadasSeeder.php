<?php

namespace Database\Seeders;

use App\Models\Pasada;
use App\Models\PasadaJuez;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PasadasSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
       //Quité la graduacion y clasificacion (Marti)
        $pasadas = [
            [
                'id_competidor' => 8,
                'id_competencia' => 2,
                'calificacion' => null,
                'id_poomsae' => 1,
                'ronda' => 1,
                'tiempo_presentacion'=>null,
                'cant_votos'=>null
            ],
            [
                'id_competidor' => 8,
                'id_competencia' => 2,
                'calificacion' => null,
                'id_poomsae' => 2,
                'ronda' => 2,
                'tiempo_presentacion'=>null,
                'cant_votos'=>null
            ],
            [
                'id_competidor' => 7,
                'id_competencia' => 2,
                'calificacion' => null,
                'id_poomsae' => 1,
                'ronda' => 1,
                'tiempo_presentacion'=>null,
                'cant_votos'=>null
            ],
            [
                'id_competidor' => 7,
                'id_competencia' => 2,
                'calificacion' => null,
                'id_poomsae' => 2,
                'ronda' => 2,
                'tiempo_presentacion'=>null,
                'cant_votos'=>null
            ],

        ];

        foreach( $pasadas as $pasada){
            Pasada::create([
                'id_competidor' => $pasada['id_competidor'],
                'id_competencia' => $pasada['id_competencia'],
                'calificacion' => $pasada['calificacion'],
                'id_poomsae' => $pasada['id_poomsae'],
                'ronda' => $pasada['ronda'],
                'tiempo_presentacion'=>$pasada['tiempo_presentacion'],
                'cant_votos'=>$pasada['cant_votos']
            ]);
        }

        /* $pasadasJuez = [
            // Juez Pepa (pasadas de competencia con id 2)
            [
                'id_juez' => 11,
                'id_pasada' => 1,
                'puntaje_exactitud' => null,
                'puntaje_presentacion' => null
            ],
            [
                'id_juez' => 11,
                'id_pasada' => 2,
                'puntaje_exactitud' => null,
                'puntaje_presentacion' => null
            ],
            [
                'id_juez' => 11,
                'id_pasada' => 3,
                'puntaje_exactitud' => null,
                'puntaje_presentacion' => null
            ],
            [
                'id_juez' => 11,
                'id_pasada' => 4,
                'puntaje_exactitud' => null,
                'puntaje_presentacion' => null
            ],
            // Juez Palma (pasadas de competencia con id 2)
            [
                'id_juez' => 12,
                'id_pasada' => 1,
                'puntaje_exactitud' => null,
                'puntaje_presentacion' => null
            ],
            [
                'id_juez' => 12,
                'id_pasada' => 2,
                'puntaje_exactitud' => null,
                'puntaje_presentacion' => null
            ],
            [
                'id_juez' => 12,
                'id_pasada' => 3,
                'puntaje_exactitud' => null,
                'puntaje_presentacion' => null
            ],
            [
                'id_juez' => 12,
                'id_pasada' => 4,
                'puntaje_exactitud' => null,
                'puntaje_presentacion' => null
            ],
            // Juez Argento (pasadas de competencia con id 2)
            [
                'id_juez' => 13,
                'id_pasada' => 1,
                'puntaje_exactitud' => null,
                'puntaje_presentacion' => null
            ],
            [
                'id_juez' => 13,
                'id_pasada' => 2,
                'puntaje_exactitud' => null,
                'puntaje_presentacion' => null
            ],
            [
                'id_juez' => 13,
                'id_pasada' => 3,
                'puntaje_exactitud' => null,
                'puntaje_presentacion' => null
            ],
            [
                'id_juez' => 13,
                'id_pasada' => 4,
                'puntaje_exactitud' => null,
                'puntaje_presentacion' => null
            ],
            // Juez Fermopolis (pasadas de competencia con id 2)
            [
                'id_juez' => 14,
                'id_pasada' => 1,
                'puntaje_exactitud' => null,
                'puntaje_presentacion' => null
            ],
            [
                'id_juez' => 14,
                'id_pasada' => 2,
                'puntaje_exactitud' => null,
                'puntaje_presentacion' => null
            ],
            [
                'id_juez' => 14,
                'id_pasada' => 3,
                'puntaje_exactitud' => null,
                'puntaje_presentacion' => null
            ],
        ];

        foreach( $pasadasJuez as $pasadaJuez){
            PasadaJuez::create([
                'id_juez' => $pasadaJuez['id_juez'],
                'id_pasada' => $pasadaJuez['id_pasada'],
                'puntaje_exactitud' => $pasadaJuez['puntaje_exactitud'],
                'puntaje_presentacion' => $pasadaJuez['puntaje_presentacion']
            ]);
        } */

    }
}
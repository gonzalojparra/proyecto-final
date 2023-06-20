<?php

namespace Database\Seeders;

use App\Models\Pasada;
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

    }
}
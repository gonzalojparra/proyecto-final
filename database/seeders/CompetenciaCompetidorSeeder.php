<?php

namespace Database\Seeders;

use App\Models\CompetenciaCompetidor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetenciaCompetidorSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
       //Quité la graduacion y clasificacion (Marti)
        $competidores = [
            [
                'id_competidor' => 8,
                'id_competencia' => 2,
                'calificacion' => null,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 7,
                'id_competencia' => 2,
                'calificacion' => null,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 1,
                'id_competencia' => 2,
                'calificacion' => null,
                'id_categoria' => 3,
                'aprobado' => 0
            ],

        ];

        foreach( $competidores as $competidor){
            CompetenciaCompetidor::create([
                'id_competidor' => $competidor['id_competidor'],
                'id_competencia' => $competidor['id_competencia'],
                'calificacion' => $competidor['calificacion'],
                'id_categoria' => $competidor['id_categoria'],
                'aprobado' => $competidor['aprobado']
            ]);
        }

    }
}
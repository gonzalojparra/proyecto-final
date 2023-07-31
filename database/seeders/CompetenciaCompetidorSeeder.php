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
           //competencia 3
           //cat 1
            [
                'id_competidor' => 9,
                'id_competencia' => 3,
                'calificacion' => 5,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 10,
                'id_competencia' => 3,
                'calificacion' => 7,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 11,
                'id_competencia' => 3,
                'calificacion' => 10,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            //cat 2
            [
                'id_competidor' => 15,
                'id_competencia' => 3,
                'calificacion' => 8.3,
                'id_categoria' => 2,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 16,
                'id_competencia' => 3,
                'calificacion' => 7.2,
                'id_categoria' => 2,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 17,
                'id_competencia' => 3,
                'calificacion' => 9,
                'id_categoria' => 2,
                'aprobado' => 1
            ],
            //cat 3
            [
                'id_competidor' => 1,
                'id_competencia' => 3,
                'calificacion' => 4.5,
                'id_categoria' => 3,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 2,
                'id_competencia' => 3,
                'calificacion' => 6.7,
                'id_categoria' => 3,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 3,
                'id_competencia' => 3,
                'calificacion' => 8,
                'id_categoria' => 3,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 4,
                'id_competencia' => 3,
                'calificacion' => 7.2,
                'id_categoria' => 3,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 5,
                'id_competencia' => 3,
                'calificacion' => 9,
                'id_categoria' => 3,
                'aprobado' => 1
            ],
            //competencia 4
            //cat1
            [
                'id_competidor' => 9,
                'id_competencia' => 4,
                'calificacion' => 9,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 10,
                'id_competencia' => 4,
                'calificacion' => 5.6,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 11,
                'id_competencia' => 4,
                'calificacion' => 7.3,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 12,
                'id_competencia' => 4,
                'calificacion' => 8.1,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 13,
                'id_competencia' => 4,
                'calificacion' => 9.2,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 14,
                'id_competencia' => 4,
                'calificacion' => 3,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            //cat3
            [
                'id_competidor' => 6,
                'id_competencia' => 4,
                'calificacion' => 10,
                'id_categoria' => 3,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 7,
                'id_competencia' => 4,
                'calificacion' => 8.2,
                'id_categoria' => 3,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 8,
                'id_competencia' => 4,
                'calificacion' => 9.3,
                'id_categoria' => 3,
                'aprobado' => 1
            ],
            //competencia 5
            //cat1
            [
                'id_competidor' => 9,
                'id_competencia' => 5,
                'calificacion' => 7,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 10,
                'id_competencia' => 5,
                'calificacion' => 7.1,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 11,
                'id_competencia' => 5,
                'calificacion' => 8.3,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 12,
                'id_competencia' => 5,
                'calificacion' => 8.5,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 13,
                'id_competencia' => 5,
                'calificacion' => 6.9,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 14,
                'id_competencia' => 5,
                'calificacion' => 9,
                'id_categoria' => 1,
                'aprobado' => 1
            ],
            //cat2
            [
                'id_competidor' => 15,
                'id_competencia' => 5,
                'calificacion' => 9.3,
                'id_categoria' => 2,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 16,
                'id_competencia' => 5,
                'calificacion' => 8.9,
                'id_categoria' => 2,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 17,
                'id_competencia' => 5,
                'calificacion' => 8.7,
                'id_categoria' => 2,
                'aprobado' => 1
            ],
            //cat3
            [
                'id_competidor' => 1,
                'id_competencia' => 5,
                'calificacion' => 7,
                'id_categoria' => 3,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 2,
                'id_competencia' => 5,
                'calificacion' => 6.8,
                'id_categoria' => 3,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 3,
                'id_competencia' => 5,
                'calificacion' => 8,
                'id_categoria' => 3,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 4,
                'id_competencia' => 5,
                'calificacion' => 7.2,
                'id_categoria' => 3,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 5,
                'id_competencia' => 5,
                'calificacion' => 6.5,
                'id_categoria' => 3,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 6,
                'id_competencia' => 5,
                'calificacion' => 4.3,
                'id_categoria' => 3,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 7,
                'id_competencia' => 5,
                'calificacion' => null,//8.1
                'id_categoria' => 3,
                'aprobado' => 1
            ],
            [
                'id_competidor' => 8,
                'id_competencia' => 5,
                'calificacion' => null,//4.3
                'id_categoria' => 3,
                'aprobado' => 1
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
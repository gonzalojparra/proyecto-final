<?php

namespace Database\Seeders;

use App\Models\CompetenciaJuez;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetenciaJuezSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
       //Quité la graduacion y clasificacion (Marti)
        $jueces = [
            [
                'id_juez' => 11,
                'id_competencia' => 1,
                'aprobado' => 1
            ],
            [
                'id_juez' => 12,
                'id_competencia' => 2,
                'aprobado' => 1
            ],
            [
                'id_juez' => 13,
                'id_competencia' => 2,
                'aprobado' => 1
            ],
            [
                'id_juez' => 12,
                'id_competencia' => 2,
                'aprobado' => 1
            ],
            [
                'id_juez' => 14,
                'id_competencia' => 1,
                'aprobado' => 0
            ],

        ];

        foreach( $jueces as $juez ){
            CompetenciaJuez::create([
                'id_juez' => $juez['id_juez'],
                'id_competencia' => $juez['id_competencia'],
                'aprobado' => $juez['aprobado']
            ]);
        }

    }
}
<?php

namespace Database\Seeders;

use App\Models\CompetenciaCategoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetenciaCategoriaSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
       //Quité la graduacion y clasificacion (Marti)
        $categorias = [
            [
                'id_competencia' => 1,
                'id_categoria' => 2,
            ],
            [
                'id_competencia' => 1,
                'id_categoria' => 3,
            ],
            [
                'id_competencia' => 2,
                'id_categoria' => 1,
            ],
            [
                'id_competencia' => 2,
                'id_categoria' => 3,
            ],
            [
                'id_competencia' => 3,
                'id_categoria' => 2,
            ],
            [
                'id_competencia' => 3,
                'id_categoria' => 3,
            ],
            [
                'id_competencia' => 3,
                'id_categoria' => 1,
            ],
            [
                'id_competencia' => 4,
                'id_categoria' => 1,
            ],
            [
                'id_competencia' => 4,
                'id_categoria' => 3,
            ],
            [
                'id_competencia' => 4,
                'id_categoria' => 2,
            ],
            [
                'id_competencia' => 5,
                'id_categoria' => 2,
            ],
            [
                'id_competencia' => 5,
                'id_categoria' => 3,
            ],
            [
                'id_competencia' => 5,
                'id_categoria' => 1,
            ],
            
        ];

        foreach( $categorias as $categoria ){
            CompetenciaCategoria::create([
                'id_competencia' => $categoria['id_competencia'],
                'id_categoria' => $categoria['id_categoria'],
            ]);
        }

    }
}

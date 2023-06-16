<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\PoomsaeCompetenciaCategoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoomsaeCompetenciaCategoriaSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $poomsaes = [
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>1,
                'id_poomsae2' => 2,
                'id_graduacion' => 1
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>4,
                'id_poomsae2' => 2,
                'id_graduacion' => 2
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>6,
                'id_poomsae2' => 2,
                'id_graduacion' => 3
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>1,
                'id_poomsae2' => 7,
                'id_graduacion' => 4
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>4,
                'id_poomsae2' => 5,
                'id_graduacion' => 5
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>6,
                'id_poomsae2' => 5,
                'id_graduacion' => 6
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>1,
                'id_poomsae2' => 2,
                'id_graduacion' => 7
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>4,
                'id_poomsae2' => 6,
                'id_graduacion' => 8
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>3,
                'id_poomsae2' => 7,
                'id_graduacion' => 9
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>12,
                'id_poomsae2' => 7,
                'id_graduacion' => 10
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>4,
                'id_poomsae2' => 11,
                'id_graduacion' => 11
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>16,
                'id_poomsae2' => 4,
                'id_graduacion' => 12
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>6,
                'id_poomsae2' => 15,
                'id_graduacion' => 13
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>8,
                'id_poomsae2' => 15,
                'id_graduacion' => 14
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>8,
                'id_poomsae2' => 10,
                'id_graduacion' => 15
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>4,
                'id_poomsae2' => 15,
                'id_graduacion' => 16
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>16,
                'id_poomsae2' => 12,
                'id_graduacion' => 17
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>6,
                'id_poomsae2' => 17,
                'id_graduacion' => 18
            ],
            [
                'id_competencia_categoria' => 1,
                'id_poomsae1' =>16,
                'id_poomsae2' => 9,
                'id_graduacion' => 19
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>1,
                'id_poomsae2' => 2,
                'id_graduacion' => 1
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>4,
                'id_poomsae2' => 1,
                'id_graduacion' => 2
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>6,
                'id_poomsae2' => 3,
                'id_graduacion' => 3
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>1,
                'id_poomsae2' => 5,
                'id_graduacion' => 4
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>4,
                'id_poomsae2' => 2,
                'id_graduacion' => 5
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>6,
                'id_poomsae2' => 4,
                'id_graduacion' => 6
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>11,
                'id_poomsae2' => 7,
                'id_graduacion' => 7
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>4,
                'id_poomsae2' => 2,
                'id_graduacion' => 8
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>16,
                'id_poomsae2' => 9,
                'id_graduacion' => 9
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>14,
                'id_poomsae2' => 7,
                'id_graduacion' => 10
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>4,
                'id_poomsae2' => 15,
                'id_graduacion' => 11
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>7,
                'id_poomsae2' => 11,
                'id_graduacion' => 12
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>9,
                'id_poomsae2' => 10,
                'id_graduacion' => 13
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>3,
                'id_poomsae2' => 4,
                'id_graduacion' => 14
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>6,
                'id_poomsae2' => 13,
                'id_graduacion' => 15
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>6,
                'id_poomsae2' => 7,
                'id_graduacion' => 16
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>4,
                'id_poomsae2' => 9,
                'id_graduacion' => 17
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>13,
                'id_poomsae2' => 9,
                'id_graduacion' => 18
            ],
            [
                'id_competencia_categoria' => 2,
                'id_poomsae1' =>6,
                'id_poomsae2' => 16,
                'id_graduacion' => 19
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>1,
                'id_poomsae2' => 2,
                'id_graduacion' => 1
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>4,
                'id_poomsae2' => 5,
                'id_graduacion' => 2
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>6,
                'id_poomsae2' => 4,
                'id_graduacion' => 3
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>1,
                'id_poomsae2' => 2,
                'id_graduacion' => 4
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>4,
                'id_poomsae2' => 3,
                'id_graduacion' => 5
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>6,
                'id_poomsae2' => 7,
                'id_graduacion' => 6
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>1,
                'id_poomsae2' => 6,
                'id_graduacion' => 7
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>4,
                'id_poomsae2' => 1,
                'id_graduacion' => 8
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>6,
                'id_poomsae2' => 2,
                'id_graduacion' => 9
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>1,
                'id_poomsae2' => 8,
                'id_graduacion' => 10
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>11,
                'id_poomsae2' => 12,
                'id_graduacion' => 11
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>4,
                'id_poomsae2' => 5,
                'id_graduacion' => 12
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>6,
                'id_poomsae2' => 7,
                'id_graduacion' => 13
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>12,
                'id_poomsae2' => 3,
                'id_graduacion' => 14
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>14,
                'id_poomsae2' => 6,
                'id_graduacion' => 15
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>8,
                'id_poomsae2' => 1,
                'id_graduacion' => 16
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>5,
                'id_poomsae2' => 6,
                'id_graduacion' => 17
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>12,
                'id_poomsae2' => 2,
                'id_graduacion' => 18
            ],
            [
                'id_competencia_categoria' => 3,
                'id_poomsae1' =>17,
                'id_poomsae2' => 15,
                'id_graduacion' => 19
            ],
        ];

        foreach( $poomsaes as $poomsae){
            PoomsaeCompetenciaCategoria::create([
                'id_competencia_categoria' => $poomsae['id_competencia_categoria'],
                'id_poomsae1' => $poomsae['id_poomsae1'],
                'id_poomsae2' => $poomsae['id_poomsae2'],
                'id_graduacion' => $poomsae['id_graduacion']
            ]);
        }

    }
}

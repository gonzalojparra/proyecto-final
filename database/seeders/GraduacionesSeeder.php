<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Graduacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GraduacionesSeeder  extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
       //Quité la graduacion y clasificacion (Marti)
        $graduaciones = [
            [
                'nombre' => "10 GUP, Blanco"
            ],
            [
                'nombre' => "9 GUP, Blanco borde amarillo"
            ],
            [
                'nombre' =>  "8 GUP, Amarillo"
            ],
            [
                'nombre' => "7 GUP, Amarillo borde verde"
            ],
            [
                'nombre' => "6 GUP, Verde"
            ],
            [
                'nombre' => "5 GUP, Verde borde azul"
            ],
            [
                'nombre' => "4 GUP, Azul"
            ],
            [
                'nombre' => "3 GUP, Azul borde rojo"
            ],
            [
                'nombre' =>  "2 GUP, Rojo"
            ],
            [
                'nombre' =>  "1 GUP, Rojo borde negro"
            ],
            [
                'nombre' => "1 DAN, Negro"
            ],
            [
                'nombre' =>  "2 DAN, Negro"
            ],
            [
                'nombre' => "3 DAN, Negro"
            ],
            [
                'nombre' =>  "4 DAN, Negro"
            ],
            [
                'nombre' => "5 DAN, Negro"
            ],
            [
                'nombre' => "6 DAN, Negro"
            ],
            [
                'nombre' =>  "7 DAN, Negro"
            ], 
            [
                'nombre' => "8 DAN, Negro"
            ],
            [
                'nombre' =>  "9 DAN, Negro"
            ]

        ];

        foreach( $graduaciones as $graduacion ){
            Graduacion::create([
                'nombre' => $graduacion['nombre'],
            ]);
        }

    }
}

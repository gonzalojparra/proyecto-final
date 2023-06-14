<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
       //Quité la graduacion y clasificacion (Marti)
        $categorias = [
            [
                'nombre' => 'Cadetes',
                'edad_desde' => 12,
                'edad_hasta' => 14,
                'genero' => 'Masculino y Femenino',
                'img' => 'inserte link de imagen'
            ],
            [
                'nombre' => 'Juveniles',
                'edad_desde' => 15,
                'edad_hasta' => 17,
                'genero' => 'Masculino y Femenino',
                'img' => 'inserte link de imagen'
            ],
            [
                'nombre' => 'Senior 1',
                'edad_desde' => 18,
                'edad_hasta' => 30,
                'genero' => 'Masculino y Femenino',
                'img' => 'inserte link de imagen'
            ],
            [
                'nombre' => 'Senior 2-Master 1',
                'edad_desde' => 31,
                'edad_hasta' => 50,
                'genero' => 'Masculino y Femenino',
                'img' => 'inserte link de imagen'
            ],
            [
                'nombre' => 'Master 2',
                'edad_desde' => 51,
                'edad_hasta' => 100,
                'genero' => 'Masculino y Femenino',
                'img' => 'inserte link de imagen'
            ]
        ];

        foreach( $categorias as $categoria ){
            Categoria::create([
                'nombre' => $categoria['nombre'],
                'edad_desde' => $categoria['edad_desde'],
                'edad_hasta' => $categoria['edad_hasta'],
                'genero' => $categoria['genero'],
                'img' => $categoria['img']
            ]);
        }

    }
}

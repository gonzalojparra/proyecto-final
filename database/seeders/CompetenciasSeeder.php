<?php

namespace Database\Seeders;

use App\Models\Competencia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetenciasSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        //
        Competencia::create([
            'titulo' => 'Compe super complicada guachin',
            'flyer' => 'inserte link de flyer',
            'bases' => 'ni idea',
            'descripcion' => 'Compe complicadisima, no se anoten',
            'fecha_inicio' => '2023-06-20',
            'fecha_fin' => '2023-06-30'
        ]);
    }

}
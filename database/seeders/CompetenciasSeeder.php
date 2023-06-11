<?php

namespace Database\Seeders;

use App\Models\Competencia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'invitacion' => 'cosas',
            'descripcion' => 'Compe complicadisima, no se anoten',
            'fecha_inicio' => '2023-06-20',
            'fecha_fin' => '2023-06-30'
        ]);

        DB::insert("INSERT INTO competencia_categoria(id_competencia, id_categoria) VALUES(1, 1)");
        DB::insert("INSERT INTO competencia_categoria(id_competencia, id_categoria) VALUES(1, 2)");
        DB::insert("INSERT INTO competencia_categoria(id_competencia, id_categoria) VALUES(1, 3)");
    }

}
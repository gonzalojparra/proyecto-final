<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {

        $this->call([
            RoleSeeder::class,
            CategoriasSeeder::class,
            zTeamsSeeder::class,
            UserSeeder::class,
            CompetenciasSeeder::class,
            PoomsaesSeeder::class
        ]);

        DB::insert('INSERT INTO competencia_competidor(id_competidor, id_competencia, calificacion, aprobado) VALUES(1, 1, 1, 1)');
        DB::insert('INSERT INTO competencia_competidor(id_competidor, id_competencia, calificacion, aprobado) VALUES(2, 1, 1, 1)');
        DB::insert('INSERT INTO competencia_competidor(id_competidor, id_competencia, calificacion, aprobado) VALUES(3, 2, 2, 1)');
        DB::insert('INSERT INTO competencia_competidor(id_competidor, id_competencia, calificacion, aprobado) VALUES(4, 2, 3, 1)');
        // \App\Models\User::factory(100)->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        
        
    }

}
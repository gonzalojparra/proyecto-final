<?php

namespace Database\Seeders;

use App\Models\Poomsae;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PoomsaesSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        //
        $path = base_path('database/seeders/data/poomsaes.json');
        $json = File::get($path);
        $poomsae = json_decode($json, true);
        foreach( $poomsae as $poom ){
            Poomsae::create([
                'nombre' => $poom['nombre'],
                'id_categoria' => $poom['id_categoria']
            ]);
        }
    }

}
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//tabla que une los poomsaes con sus respectivas categorias y graduaciones por competencia (Marti)
return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('poomsae_competencia_categoria', function (Blueprint $table) {
            $table->foreignId('id_competencia_categoria')->constrained('competencia_categoria');
            $table->foreignId('id_poomsae1')->constrained('poomsaes');
            $table->foreignId('id_poomsae2')->constrained('poomsaes');
            $table->foreignId('id_graduacion')->constrained('graduaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('poomsae_competencia_categoria');
    }

};
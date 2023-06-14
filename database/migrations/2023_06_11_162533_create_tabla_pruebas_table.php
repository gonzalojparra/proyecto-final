<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//tabla que une los poomsaes con sus respectivas categorias y graduaciones por competencia (Marti)
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('poomsae_competencia', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('id_usuario');
            $table->string('id_competencia');
            $table->string('id_poomsae');
            $table->string('id_categoria');
            $table->string('graduacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_pruebas');
    }
};

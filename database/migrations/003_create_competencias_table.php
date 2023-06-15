<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('competencias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('flyer');
            $table->string('bases'); // Tipo de dato que guarda archivo PDF en binario...
            $table->string('descripcion');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('cant_jueces')->default(0); // Se inicia en 0 e irá aumentando a medida que se inscriban jueces
            $table->integer('estado')->default(1); // 1 = inscripcion de jueces / 2 = inscripcion de competidores / 3 = inscripcion cerrada y competencia en curso / 4 = competencia finalizada
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('competencias');
    }

};
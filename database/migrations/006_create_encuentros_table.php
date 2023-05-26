<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('encuentros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_competidor1')->constrained('competidores');
            $table->foreignId('id_competidor2')->constrained('competidores');
            $table->unsignedBigInteger('id_competencia');
            $table->float('calificacion_competidor1');
            $table->float('calificacion_competidor2');
            $table->string('categoria');
            $table->integer('num_ronda');
            $table->timestamps();

            $table->foreign('id_competencia')->references('id')
              ->on('competencias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('encuentros');
    }

};
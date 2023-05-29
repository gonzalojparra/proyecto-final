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
            $table->unsignedBigInteger('id_competencia');
            $table->unsignedBigInteger('id_competidor1');
            $table->unsignedBigInteger('id_competidor2');
            $table->float('calificacion_competidor1');
            $table->float('calificacion_competidor2');
            $table->string('categoria');
            $table->integer('ronda');
            // $table->timestamps('fecha_inicio');
            $table->timestamps();

            $table->foreign('id_competencia')->references('id')
              ->on('competencias');
            $table->foreign('id_competidor1')->references('id_user')
            ->on('competidores');
            $table->foreign('id_competidor2')->references('id_user')
            ->on('competidores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('encuentros');
    }

};
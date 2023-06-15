<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('competencia_competidor', function (Blueprint $table) {
            $table->foreignId('id_competidor')->constrained('users');
            $table->foreignId('id_competencia')->constrained('competencias');
            $table->float('calificacion')->nullable();
            $table->boolean('aprobado')->default(0); // Para saber si el admin aprobo la inscripcion a la competencia.

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('competencia_competidor');
    }

};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('pasadas', function (Blueprint $table) {
            $table->id();
            $table->integer('ronda');
            $table->foreignId('id_poomsae')->constrained('poomsaes');
            $table->foreignId('id_competidor')->constrained('users');
            $table->float('tiempo_presentacion')->nullable();
            $table->float('calificacion')->nullable();
            $table->integer('cant_votos')->nullable();
            $table->foreignId('id_competencia')->constrained('competencias');
            $table->boolean('seleccionado')->default(0);
            $table->boolean('estado_timer')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('pasadas');
    }

};

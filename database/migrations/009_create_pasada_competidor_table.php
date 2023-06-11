<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('pasada_competidor', function (Blueprint $table) {
            $table->id();
            $table->float('calificacion');
            $table->float('tiempo_presentacion');
            $table->foreignId('id_competidor')->constrained('users');
            $table->foreignId('id_poomsae')->constrained('poomsaes');
            $table->float('votos_jurado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('poomsaes');
    }

};

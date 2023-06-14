<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('competencia_juez', function (Blueprint $table) {
            $table->foreignId('id_juez')->constrained('users');
            $table->foreignId('id_competencia')->constrained('competencias');
            $table->boolean('aprobado');
            $table->timestamps();
        });
    }
    //cambie el timestamp de inscripto por el booleano aprobado
    // y también quité id_poomsae y id_competencias (Marti)

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('competencia_juez');
    }

};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('poomsaes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('competencia_competidor_poomsae');
            $table->unsignedBigInteger('competencia_juez_poomsae');
            $table->foreignId('id_categoria')->constrained('categorias');
            $table->timestamps();

            $table->foreign('competencia_competidor_poomsae')->references('id')
              ->on('users');
            $table->foreign('competencia_juez_poomsae')->references('id')
              ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('poomsaes');
    }

};

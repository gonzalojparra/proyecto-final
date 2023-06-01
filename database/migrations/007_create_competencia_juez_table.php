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
<<<<<<< Updated upstream:database/migrations/007_create_competencia_juez_table.php
            $table->foreignId('id_competencias')->constrained('competencias');
=======
            $table->foreignId('id_poomsae')->constrained('poomsaes');
            $table->timestamp('inscripto')->nullable();
>>>>>>> Stashed changes:database/migrations/005_create_competencia_juez_table.php
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('competencia_juez');
    }

};
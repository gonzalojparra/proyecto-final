<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        //
        Schema::create('pasadas_juez', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_juez')->constrained('users');
            $table->foreignId('id_pasada')->constrained('pasadas');
            $table->float('puntaje_exactitud')->nullable();
            $table->float('puntaje_presentacion')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        //
        Schema::dropIfExists('pasadas_juez');
    }

};
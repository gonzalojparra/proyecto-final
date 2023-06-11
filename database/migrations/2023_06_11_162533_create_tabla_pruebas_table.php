<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tabla_pruebas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('id_usuario');
            $table->string('id_competencia');
            $table->string('id_poomsae');
            $table->string('categoria');
            $table->boolean('validado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_pruebas');
    }
};

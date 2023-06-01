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
        Schema::create('competencia_categoria', function (Blueprint $table) {
            $table->foreignId('id_competencia')->constrained('competencias');
            $table->foreignId('id_categoria')->constrained('categorias');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competencia_categoria');
    }
};

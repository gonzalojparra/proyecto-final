<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('edad_desde'); // incluído
            $table->integer('edad_hasta'); // incluído
            $table->string('genero');
            $table->string('img');
            $table->timestamps();
        });
    }
//Quité la graduacion y clasificacion (Marti)
    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('categorias');
    }

};
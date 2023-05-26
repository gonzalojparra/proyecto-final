<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function PHPUnit\Framework\once;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('competidores', function (Blueprint $table) {
            $table->id();
            $table->string('gal')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('du', false, true);
            $table->date('fecha_nac');
            $table->string('email');
            $table->string('genero');
            $table->string('graduacion');
            $table->float('clasificacion', 5, 2, true)->nullable();

            $table->string('pais_nombre');
            $table->string('categoria');
            $table->string('colegio_nombre');

            // agrega campo timestamp de fecha de eliminacion
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('pais_nombre')->references('nombre')
              ->on('paises');
            $table->foreign('categoria')->references('nombre')
              ->on('categorias');
            $table->foreign('colegio_nombre')->references('nombre')
              ->on('colegios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('competidores');
    }

};
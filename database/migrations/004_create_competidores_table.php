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
            $table->foreignId('id_user')->constrained('users');
            $table->string('gal')->unique();
            $table->integer('du', false, true);
            $table->string('genero');
            $table->unsignedBigInteger('id_colegio');
            $table->string('graduacion');
            $table->float('clasificacion', 5, 2, true)->nullable();
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_pais');

            // agrega campo timestamp de fecha de eliminacion
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('id_pais')->references('id')
              ->on('paises');
            $table->foreign('id_categoria')->references('id')
              ->on('categorias');
            $table->foreign('id_colegio')->references('id')
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
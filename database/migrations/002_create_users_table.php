<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();

            $table->date('fecha_nac')->nullable();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->unsignedBigInteger('id_escuela')->nullable();
            $table->string('gal')->nullable();
            $table->integer('du')->nullable();
            $table->float('clasificacion')->default(0);
            $table->string('graduacion')->nullable();
            $table->unsignedBigInteger('id_categoria')->nullable(); // Se calcula por edad de fecha nac
            $table->string('genero')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('verificado')->default(false);
            $table->timestamps();

            $table->foreign('id_escuela')->references('id')
              ->on('teams');
            $table->foreign('id_categoria')->references('id')
              ->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('users');
    }

};
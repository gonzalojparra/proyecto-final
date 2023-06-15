<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('actualizaciones', function (Blueprint $table) {
            $table->foreignId('id_user')->constrained('users');
            $table->integer('id_colegio_nuevo');
            $table->string('graduacion_nueva');
            $table->string('gal_nuevo')->nullable();
            $table->timestamps();
        });
    }
//agregue gal_nuevo (Marti)
    public function down(): void
    {
        Schema::dropIfExists('actualizaciones');
    }
};

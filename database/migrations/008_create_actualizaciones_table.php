<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActualizacionesTable extends Migration
{
    public function up()
    {
        Schema::create('actualizaciones', function (Blueprint $table) {
            $table->foreignId('id_user')->constrained('users');
            $table->text('id_colegio_nuevo');
            $table->string('graduacion_nueva');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('actualizaciones');
    }
}

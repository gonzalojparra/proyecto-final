<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActualizacionesTable extends Migration
{
    public function up()
    {
        Schema::create('actualizaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->text('descripcion');
            $table->string('informacion_actual');
            $table->string('informacion_nueva');
            $table->timestamp('fecha_solicitud')->nullable();
            $table->boolean('aprobada')->default(false);
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('actualizaciones');
    }
}

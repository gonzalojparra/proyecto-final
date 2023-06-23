<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('actualizaciones', function (Blueprint $table) {
            $table->foreignId('id_user')->constrained('users');
            $table->foreignId('id_escuela_nueva')->nullable()->constrained('teams');
            $table->foreignId('id_graduacion_nueva')->nullable()->constrained('graduaciones');
            $table->string('gal_nuevo')->nullable();
            $table->boolean('resuelto')->default(false);
            $table->timestamps();
        });
    }
    
    public function down(): void {
        Schema::dropIfExists('actualizaciones');
    }

};
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
        if (!Schema::hasTable('poomsaes')) {
            Schema::create('poomsaes', function (Blueprint $table) {
                $table->id();
                $table->string('nombre');
                $table->timestamps();
            });
        }
    }
    //quité id categorias (marti)
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poomsaes');
    }
};

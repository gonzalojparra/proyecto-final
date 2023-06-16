<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoomsaeCompetenciaCategoria extends Model {
    use HasFactory;

    protected $table = 'poomsae_competencia_categoria';

    protected $fillable = [
        'id_competencia_categoria', 'id_poomsae1', 'id_poomsae2', 'id_graduacion'
    ];

}
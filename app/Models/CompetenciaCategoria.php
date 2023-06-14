<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetenciaCategoria extends Model
{
    use HasFactory;

    protected $table = 'competencia_categoria';
    protected $fillable = [
        'id_competencia', 'id_categoria'
    ];
}

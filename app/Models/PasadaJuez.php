<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasadaJuez extends Model {
    use HasFactory;

    protected $table = 'pasadas_juez';
    protected $fillable = [
        'id_juez',
        'id_pasada',
        'puntaje_exactitud',
        'puntaje_presentacion'
    ];
    
}
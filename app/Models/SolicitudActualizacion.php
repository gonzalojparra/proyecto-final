<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudActualizacion extends Model {
    use HasFactory;
    protected $table = 'actualizaciones';

    protected $fillable = [
        'id_user',
        'id_colegio_nuevo',
        'graduacion_nueva',
        'gal_nuevo',
    ];

}

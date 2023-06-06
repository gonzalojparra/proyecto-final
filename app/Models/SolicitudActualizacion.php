<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudActualizacion extends Model
{
    use HasFactory;
    protected $table = 'actualizaciones';

    protected $fillable = [
        'id',
        'usuario_id',
        'descripcion',
        'informacion_actual',
        'informacion_nueva',
        'fecha_solicitud',
        'aprobada',
        // Agrega aquí los nombres de los campos adicionales
    ];

    // Puedes definir relaciones aquí si es necesario
}

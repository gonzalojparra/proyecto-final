<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use App\Models\Graduacion;

class Actualizacion extends Model
{
    use HasFactory;
    protected $table = 'actualizaciones';

    protected $fillable = [
        'id_user',
        'id_escuela_nueva',
        'id_graduacion_nueva',
        'gal_nuevo',
        // Agrega aquí los nombres de los campos adicionales
    ];

    // public function team()
    // {
    //     return $this->hasOne(Team::class, 'id_escuela_nueva');
    // }

    public function team()
    {
        return $this->belongsTo(Team::class, 'id_escuela_nueva');
    }

    public function graduacion()
    {
        return $this->belongsTo(Graduacion::class, 'id_graduacion_nueva');
    }

    
}

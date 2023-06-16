<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;

class Actualizacion extends Model
{
    use HasFactory;
    protected $table = 'actualizaciones';

    protected $fillable = [
        'id_user',
        'id_escuela_nueva',
        'graduacion_nueva',
        'gal_nuevo',
        // Agrega aquí los nombres de los campos adicionales
    ];

    public function team()
    {
        return $this->hasOne(Team::class, 'id');
    }
}

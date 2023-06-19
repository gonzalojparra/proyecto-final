<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasada extends Model {
    use HasFactory;

    protected $table = 'pasadas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'ronda',
        'id_poomsae',
        'id_competidor',
        'tiempo_presentacion',
        'calificacion',
        'cant_votos',
        'id_competencia'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_competidor');
    }

    public function poomsae()
    {
        return $this->belongsTo(Poomsae::class, 'id_poomsae');
    }

}
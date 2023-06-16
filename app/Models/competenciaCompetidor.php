<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CompetenciaCompetidor extends Model {
    use HasFactory;

    protected $table = 'competencia_competidor';
    protected $fillable = [
        'id_competidor',
        'id_competencia',
        'calificacion',
        'aprobado',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_competidor');
    }
}
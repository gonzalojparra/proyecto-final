<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competencia extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'competencias';
    protected $fillable = [
        'titulo', 'flyer', 'bases', 'descripcion',
        'fecha_inicio', 'fecha_fin', 'estado'
    ];
}
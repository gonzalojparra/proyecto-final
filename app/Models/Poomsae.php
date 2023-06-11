<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poomsae extends Model {
    use HasFactory;

    protected $table = 'poomsaes';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'id_categoria'];
}

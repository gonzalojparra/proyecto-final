<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Pais;


class Competidor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'competidores'; // Especifica el nombre de la tabla
    protected $fillable = [
        'legajo',
        'nombre',
        'apellido',
        'du',
        'fecha_nac',
        'pais_nombre',
        'email',
        'genero',
        'graduacion',
        'clasificacion',
    ];

    protected $dates = ['deleted_at'];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'pais_nombre', 'nombre');
    }

    /**
     * Buscar un modelo por el valor de una columna específica.
     *
     * @param string $column
     * @param mixed $value
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function findByColumn($column, $value)
    {
        return static::where($column, '=', $value)->get();
    }
}

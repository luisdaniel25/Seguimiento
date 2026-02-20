<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fichadecaracterizacion extends Model
{
    protected $table = 'tbl_fichadecaracterizacion';

    protected $primaryKey = 'NIS';

    protected $casts = [
        'Codigo' => 'int',
        'Cupo' => 'int',
        'FechaInicio' => 'datetime',
        'FechaFin' => 'datetime',
    ];

    protected $fillable = [
        'Codigo',
        'Denominacion',
        'Cupo',
        'FechaInicio',
        'FechaFin',
        'Observaciones',
    ];

    public function programasdeformacions()
    {
        return $this->hasMany(Programasdeformacion::class, 'tbl_fichadecaracterizacion_NIS');
    }
}

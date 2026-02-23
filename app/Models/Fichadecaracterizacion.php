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

    public $incrementing = true;

    public  $timestamps = true;

    protected $casts = [
        'Codigo' => 'int',
        'Cupo' => 'int',
        'FechaInicio' => 'date',
        'FechaFin' => 'date',
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

<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programasdeformacion extends Model
{
    protected $table = 'tbl_programasdeformacion';

    protected $primaryKey = 'NIS';

    public $timestamps = true;

    public $incrementing = true;

    protected $casts = [
        'Codigo' => 'int',
        'tbl_fichadecaracterizacion_NIS' => 'int',
    ];

    protected $fillable = [
        'Codigo',
        'Denominacion',
        'Observaciones',
        'tbl_fichadecaracterizacion_NIS',
    ];

    public function fichadecaracterizacion()
    {
        return $this->belongsTo(Fichadecaracterizacion::class, 'tbl_fichadecaracterizacion_NIS');
    }

    public function aprendices()
    {
        return $this->hasMany(Aprendice::class, 'tbl_programasdeformacion_NIS');
    }
}

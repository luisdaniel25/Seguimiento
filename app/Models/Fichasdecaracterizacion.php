<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fichasdecaracterizacion extends Model
{
    protected $table = 'tbl_fichasdecaracterizacion';

    protected $primaryKey = 'NIS';

    public $timestamps = false;

    protected $casts = [
        'Codigo' => 'int',
        'Cupo' => 'int',
        'Fechainicio' => 'datetime',
        'Fechafin' => 'datetime',
        'tblprogramasdeformacion_NIS' => 'int',
        'tblcentrosdeformacion_NIS' => 'int',
    ];

    protected $fillable = [
        'Codigo',
        'Denominacion',
        'Cupo',
        'Fechainicio',
        'Fechafin',
        'Observaciones',
        'tblprogramasdeformacion_NIS',
        'tblcentrosdeformacion_NIS',
    ];

    public function programasformacion()
    {
        return $this->belongsTo(Programasdeformacion::class, 'tblprogramasdeformacion_NIS');
    }

    public function centrosformacion()
    {
        return $this->belongsTo(Centrosformacion::class, 'tblcentrosdeformacion_NIS');
    }

    public function aprendices()
    {
        return $this->hasMany(Aprendice::class, 'tblfichasdecaracterizacion_NIS');
    }
}

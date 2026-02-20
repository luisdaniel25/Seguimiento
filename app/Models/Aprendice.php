<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aprendice extends Model
{
    protected $table = 'tbl_aprendices';
    protected $primaryKey = 'NIS';

    public $timestamps = true;

    protected $casts = [
        'NumDoc' => 'int',
        'Sexo' => 'int',
        'FechaNac' => 'date',
        'tbl_tiposdocumentos_nis' => 'int',
        'tbl_programasdeformacion_NIS' => 'int',
        'tbl_centrodeformacion_NIS' => 'int',
        'tbl_eps_nis' => 'int',
    ];

    protected $fillable = [
        'NumDoc',
        'Nombres',
        'Apellidos',
        'Direccion',
        'Telefono',
        'CorreoInstitucional',
        'CorreoPersonal',
        'Sexo',
        'FechaNac',
        'tbl_tiposdocumentos_nis',
        'tbl_programasdeformacion_NIS',
        'tbl_centrodeformacion_NIS',
        'tbl_eps_nis',
    ];



    public function centrodeformacion()
    {
        return $this->belongsTo(Centrodeformacion::class, 'tbl_centrodeformacion_NIS');
    }

    public function eps()
    {
        return $this->belongsTo(Eps::class, 'tbl_eps_nis');
    }

    public function programasdeformacion()
    {
        return $this->belongsTo(Programasdeformacion::class, 'tbl_programasdeformacion_NIS');
    }

    public function tiposdocumento()
    {
        return $this->belongsTo(Tiposdocumento::class, 'tbl_tiposdocumentos_nis');
    }
}

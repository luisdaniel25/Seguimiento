<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fichadecaracterizacion
 * 
 * @property int $NIS
 * @property int $Codigo
 * @property string $Denominacion
 * @property int $Cupo
 * @property Carbon|null $FechaInicio
 * @property Carbon|null $FechaFin
 * @property string|null $Observaciones
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Programasdeformacion[] $programasdeformacions
 *
 * @package App\Models
 */
class Fichadecaracterizacion extends Model
{
	protected $table = 'tbl_fichadecaracterizacion';
	protected $primaryKey = 'NIS';

	protected $casts = [
		'Codigo' => 'int',
		'Cupo' => 'int',
		'FechaInicio' => 'datetime',
		'FechaFin' => 'datetime'
	];

	protected $fillable = [
		'Codigo',
		'Denominacion',
		'Cupo',
		'FechaInicio',
		'FechaFin',
		'Observaciones'
	];

	public function programasdeformacions()
	{
		return $this->hasMany(Programasdeformacion::class, 'tbl_fichadecaracterizacion_NIS');
	}
}

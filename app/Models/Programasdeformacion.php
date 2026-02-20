<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Programasdeformacion
 * 
 * @property int $NIS
 * @property int $Codigo
 * @property string $Denominacion
 * @property string|null $Observaciones
 * @property int $tbl_fichadecaracterizacion_NIS
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Fichadecaracterizacion $fichadecaracterizacion
 * @property Collection|Aprendice[] $aprendices
 *
 * @package App\Models
 */
class Programasdeformacion extends Model
{
	protected $table = 'tbl_programasdeformacion';
	protected $primaryKey = 'NIS';

	protected $casts = [
		'Codigo' => 'int',
		'tbl_fichadecaracterizacion_NIS' => 'int'
	];

	protected $fillable = [
		'Codigo',
		'Denominacion',
		'Observaciones',
		'tbl_fichadecaracterizacion_NIS'
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

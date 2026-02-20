<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;


class Eps extends Model
{
	protected $table = 'tbl_eps';
	protected $primaryKey = 'nis';

	protected $casts = [
		'numdoc' => 'int'
	];

	protected $fillable = [
		'numdoc',
		'denominacion',
		'observaciones'
	];

	public function aprendices()
	{
		return $this->hasMany(Aprendice::class, 'tbl_eps_nis');
	}

	public function instructores()
	{
		return $this->hasMany(Instructore::class, 'tbl_eps_nis');
	}
}

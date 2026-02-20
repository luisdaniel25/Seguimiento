<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Instructore
 *
 * @property int $NIS
 * @property int $NumDoc
 * @property string $Nombres
 * @property string $Apellidos
 * @property string $Direccion
 * @property string $Telefono
 * @property string $CorreoInstitucional
 * @property string $CorreoPersonal
 * @property int $Sexo
 * @property Carbon $FechaNac
 * @property int $tbl_tiposdocumentos_nis
 * @property int $tbl_eps_nis
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Ep $ep
 * @property Tiposdocumento $tiposdocumento
 */
class Instructore extends Model
{
    protected $table = 'tbl_instructores';

    protected $primaryKey = 'NIS';

    protected $casts = [
        'NumDoc' => 'int',
        'Sexo' => 'int',
        'FechaNac' => 'datetime',
        'tbl_tiposdocumentos_nis' => 'int',
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
        'tbl_eps_nis',
    ];

    public function eps()
    {
        return $this->belongsTo(Eps::class, 'tbl_eps_nis');
    }

    public function tiposdocumento()
    {
        return $this->belongsTo(Tiposdocumento::class, 'tbl_tiposdocumentos_nis');
    }
}

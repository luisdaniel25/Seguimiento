<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'archivos';

    protected $fillable = [
        'nombre_original',
        'nombre_guardado',
        'ruta',
        'tipo_mime',
        'tamaño',
        'descripcion'
    ];

    // Accesor para tamaño legible
    public function getTamanoFormateadoAttribute()
    {
        return number_format($this->tamaño / 1024, 2) . ' KB';
    }
}

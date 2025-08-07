<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargadorFoto extends Model
{
    protected $table = 'cargador_fotos';

    protected $fillable = [
        'cargador_id', 'nombre_archivo', 'ruta'
    ];

    // (opcional) accesor URL
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->ruta);
    }
}

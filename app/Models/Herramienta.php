<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Herramienta;


class Herramienta extends Model
{
    protected $table = 'herramienta';

    protected $fillable = [
        'nombre', 
        'descripcion', 
        'estado_id', 
        'peso', 
        'fecha', 
        'hora', 
        'user_id'
    ];

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }


}

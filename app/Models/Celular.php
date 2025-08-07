<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Celular extends Model
{
    use HasFactory;

    protected $table = 'celular';

    protected $fillable = [
        'marca',
        'modelo',
        'nombre_modelo',
        'memoria_interna',
        'resolucion',
        'condicion_pantalla',
        'disponibilidad',
        'estado',
        'test',
        'almacen_id',
        'entrada',
        'comentarios',
        'precio_venta',
        'imagen',
        'numero_modelo',
        'numero_serie',
        'imei_1',
        'imei_2'
    ];

    public function fotos()
    {
        return $this->hasMany(CelularFoto::class, 'celular_id');
    }


    public function almacen()
    {
        return $this->belongsTo(\App\Models\Almacen::class);
    }
}

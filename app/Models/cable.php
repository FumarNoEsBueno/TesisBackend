<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cable extends Model
{
    protected $table='cable';
    protected $fillable = [
        'cable_nombre',
        'cable_cantidad',
        'cable_precio',
        'cable_foto',
        'descuento_id',
        'disponibilidad_id',
        'almacen_id',
        'estado_id',
        'marca_id',
        'tipo_entrada_id',
        ];
    use HasFactory;
}

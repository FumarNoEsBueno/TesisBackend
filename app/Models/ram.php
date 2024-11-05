<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ram extends Model
{
    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'ram_compra');
    }

    protected $table='ram';
    protected $fillable = ['ram_descripcion',
        'ram_nombre',
        'ram_foto',
        'ram_precio',
        'ram_descuento',
        'ram_destacado',
        'disponibilidad_id',
        'almacen_id',
        'estado_id',
        'marca_id',
        'tipo_ram_id',
        'capacidad_ram_id',
        'tamano_ram_id',
        'velocidad_ram_id'];
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cable extends Model
{
    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'compra_cable')->withPivot('compra_cable_cantidad');
    }

    protected $table='cable';
    protected $fillable = [
        'cable_nombre',
        'cable_cantidad',
        'cable_precio',
        'cable_foto',
        'cable_descuento',
        'cable_destacado',
        'solicitud_recepcion_id',
        'disponibilidad_id',
        'almacen_id',
        'estado_id',
        'marca_id',
        'tipo_entrada_id',
        ];
    use HasFactory;
}

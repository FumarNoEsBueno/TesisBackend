<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cable extends Model
{
    use HasFactory;
    protected $table = 'cable';

    protected $fillable = [
        'cable_nombre',
        'marca_id',
        'disponibilidad_id',
        'comentario',
        'estado_id',
        'test',
        'largo',
        'almacen_id',
        'descripcion',
        'cable_precio_unitario',
        'cable_precio_final',
        'cable_foto',
        'cable_descuento',
        'cable_destacado',
        'solicitud_recepcion_id',
        'tipo_entrada_id',      // un único ID en tu migración
        'tipo_entrada_1_id',    // si realmente necesitas dos tipos
        'tipo_entrada_2_id'
    ];

    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'compra_cable')->withPivot('compra_cable_cantidad');
    }

    public function almacen()
    {
        return $this->belongsTo(almacen::class, 'almacen_id');
    }
    public function solicitudRecepcion()
    {
        return $this->belongsTo(solicitud_recepcion::class, 'solicitud_recepcion_id');
    }
    public function disponibilidad()
    {
        return $this->belongsTo(disponibilidad::class, 'disponibilidad_id');
    }
    public function estado()
    {
        return $this->belongsTo(estado::class, 'estado_id');
    }
    public function marca()
    {
        return $this->belongsTo(marca::class, 'marca_id');
    }
    public function tipoEntrada()
    {
        return $this->belongsTo(tipo_entrada::class, 'tipo_entrada_id');
    }

    
    
}

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

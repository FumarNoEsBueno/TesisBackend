<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\RegistrarEnProducto;

class Ram extends Model
{
    use RegistrarEnProducto;
    
    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'ram_compra');
    }
    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }
    public function tipoRam()
    {
        return $this->belongsTo(TipoRam::class, 'tipo_ram_id');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
    public function Disponibilidad()
    {
        return $this->belongsTo(Disponibilidad::class, 'disponibilidad_id');
    }
    public function capacidadRam()
    {
        return $this->belongsTo(CapacidadRam::class, 'CapacidadRam_id');
    }
    public function tamanoRam()
    {
        return $this->belongsTo(TamanoRam::class, 'tamano_ram_id');
    }
    public function velocidadRam()
    {
        return $this->belongsTo(VelocidadRam::class, 'velocidad_ram_id');
    }
    public function solicitudRecepcion()
    {
        return $this->belongsTo(SolicitudRecepcion::class, 'solicitud_recepcion_id');
    }

    protected $table='ram';
    protected $fillable = [
        'ram_descripcion',
        'ram_nombre',
        'ram_foto',
        'ram_precio',
        'ram_descuento',
        'ram_destacado',
        'solicitud_recepcion_id',
        'disponibilidad_id',
        'almacen_id',
        'estado_id',
        'marca_id',
        'tipo_ram_id',
        'CapacidadRam_id',
        'tamano_ram_id',
        'velocidad_ram_id'];
    use HasFactory;
}

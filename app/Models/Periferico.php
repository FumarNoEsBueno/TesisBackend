<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periferico extends Model
{
    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'periferico_compra');
    }
    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }
    public function tipoEntrada()
    {
        return $this->belongsTo(TipoEntrada::class, 'tipo_entrada_id');
    }
    public function tipoPeriferico()
    {
        return $this->belongsTo(TipoPeriferico::class, 'tipo_periferico_id');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id');
    }
    public function Disponibilidad()
    {
        return $this->belongsTo(Disponibilidad::class, 'disponibilidad_id');
    }

    protected $table='periferico';
    protected $fillable = [
        'periferico_nombre',
        'periferico_foto',
        'periferico_descripcion',
        'periferico_precio',
        'solicitud_recepcion_id',
        'disponibilidad_id',
        'periferico_descuento',
        'periferico_destacado',
        'almacen_id',
        'estado_id',
        'marca_id',
        'tipo_entrada_id',
        'tipo_periferico_id'];
    use HasFactory;
}

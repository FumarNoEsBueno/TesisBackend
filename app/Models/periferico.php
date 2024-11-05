<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class periferico extends Model
{
    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'periferico_compra');
    }

    protected $table='periferico';
    protected $fillable = [
        'periferico_nombre',
        'periferico_foto',
        'periferico_descripcion',
        'periferico_precio',
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

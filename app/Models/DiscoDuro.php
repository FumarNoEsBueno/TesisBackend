<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\RegistrarEnProducto;

class DiscoDuro extends Model
{
    use RegistrarEnProducto;

    public function recepcion()
    {
        return $this->belongsTo(solicitud_recepcion::class,'solicitud_recepcion_id', 'id');
    }
    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'disco_duro_compra');
    }

    public function Disponibilidad()
    {
        return $this->belongsTo(Disponibilidad::class);
    }

    public function estado()
    {
        return $this->belongsTo(estado::class);
    }

    public function Tamano()
    {
        return $this->belongsTo(Tamano::class);
    }

    public function marca()
    {
        return $this->belongsTo(marca::class);
    }

    public function archivos()
    {
        return $this->belongsTo(SistemaArchivos::class);
    }

    public function entrada()
    {
        return $this->belongsTo(TipoEntrada::class);
    }

    public function descuento()
    {
        return $this->belongsTo(descuento::class);
    }

    protected $table='disco_duro';
    
    protected $fillable = [
        'disco_duro_memoria',
        'disco_duro_nombre',
        'disco_duro_foto',
        'disco_duro_crystaldisk',
        'disco_duro_horas_encendido',
        'disco_duro_esperanza_vida',
        'disco_duro_precio',
        'solicitud_recepcion_id',
        'disponibilidad_id',
        'disco_duro_descuento',
        'disco_duro_destacado',
        'almacen_id',
        'estado_id',
        'tamano_id',
        'marca_id',
        'sistema_archivos_id',
        'tipo_entrada_id'
    ];
    use HasFactory;
}

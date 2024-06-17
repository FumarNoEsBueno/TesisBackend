<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class disco_duro extends Model
{

    public function disponibilidad()
    {
        return $this->belongsTo(disponibilidad::class);
    }

    public function estado()
    {
        return $this->belongsTo(estado::class);
    }

    public function tamano()
    {
        return $this->belongsTo(tamano::class);
    }

    public function marca()
    {
        return $this->belongsTo(marca::class);
    }

    public function archivos()
    {
        return $this->belongsTo(sistema_archivos::class);
    }

    public function entrada()
    {
        return $this->belongsTo(tipo_entrada::class);
    }

    public function descuento()
    {
        return $this->belongsTo(model_descuento::class);
    }

    public function compra()
    {
        return $this->belongsTo(compra::class);
    }

    protected $table='disco_duro';
    protected $fillable = ['disco_duro_memoria',
        'disco_duro_nombre',
        'disco_duro_foto',
        'disco_duro_crystaldisk',
        'disco_duro_horas_encendido',
        'disco_duro_esperanza_vida',
        'disco_duro_precio',
        'descuento_id',
        'disponibilidad_id',
        'almacen_id',
        'estado_id',
        'tamano_id',
        'marca_id',
        'sistema_archivos_id',
        'tipo_entrada_id'];
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class disco_duro extends Model
{
    protected $table='disco_duro';
    protected $fillable = ['disco_duro_memoria',
        'disco_duro_nombre',
        'disco_duro_foto',
        'disco_duro_crystaldisk',
        'disco_duro_horas_encendido',
        'disco_duro_esperanza_vida',
        'disco_duro_precio',
        'compra_id',
        'disponibilidad_id',
        'almacen_id',
        'estado_id',
        'tamano_id',
        'marca_id',
        'sistema_archivos_id',
        'tipo_entrada_id'];
    use HasFactory;
}

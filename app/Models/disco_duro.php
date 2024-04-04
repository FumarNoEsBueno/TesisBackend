<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class disco_duro extends Model
{
    protected $fillable = ['disco_duro_memoria','disco_duro_crystaldisk','disco_duro_horas_encendido','disco_duro_esperanza_vida','disponibilidad_id','almacen_id','estado_id','tamano_id','marca_id','sistema_archivos_id'];
    use HasFactory;
}

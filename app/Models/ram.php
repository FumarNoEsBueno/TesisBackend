<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ram extends Model
{
    protected $table='ram';
    protected $fillable = ['ram_descripcion','ram_precio','disponibilidad_id','almacen_id','estado_id','marca_id','tipo_ram_id','tamano_ram_id','velocidad_ram_id'];
    use HasFactory;
}

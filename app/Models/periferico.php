<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class periferico extends Model
{
    protected $table='periferico';
    protected $fillable = ['periferico_descripcion','disponibilidad_id','almacen_id','estado_id','marca_id','tipo_entrada_id','tipo_periferico_id'];
    use HasFactory;
}

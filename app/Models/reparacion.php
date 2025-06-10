<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparacion extends Model
{
    use HasFactory;

    protected $table = 'reparacion';


    protected $fillable = [
        'id_usuario',
        'tipo_reparado',
        'id_reparado',
        'detalle_reparacion',
        'observaciones',
        'fecha_reparacion',
    ];
    
}

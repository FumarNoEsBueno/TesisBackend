<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporte extends Model
{
    use HasFactory;

    protected $table ='transporte';

    protected $fillable = 
    [
        'transporte_solicitante',
        'transporte_desde',
        'transporte_hacia',
        'transporte_cuando',
        'transporte_hora',
        'transporte_descripcion',
    ];
}

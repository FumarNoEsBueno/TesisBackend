<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerifericoCompra extends Model
{
    protected $table='periferico_compra';
    protected $fillable = ['periferico_id',
        'periferico_compra_descuento',
        'compra_id'];
    use HasFactory;
}

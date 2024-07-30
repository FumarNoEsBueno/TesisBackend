<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class periferico_compra extends Model
{
    protected $table='periferico_compra';
    protected $fillable = ['periferico_id',
        'descuento_id',
        'compra_id'];
    use HasFactory;
}

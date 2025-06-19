<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    protected $table='metodo_pago';
    protected $fillable = ['metodo_pago_nombre', 'metodo_pago_slug'];
    use HasFactory;
}

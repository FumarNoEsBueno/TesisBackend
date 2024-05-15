<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compra extends Model
{
    protected $table='compra';
    protected $fillable = ['compra_codigo',
        'compra_email',
        'direccion_id',
        'medoto_pago_id',
        'medoto_despacho_id'];
    use HasFactory;
}

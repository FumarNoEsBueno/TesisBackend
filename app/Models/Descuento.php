<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    protected $table='descuento';
    protected $fillable = ['descuento_porcentaje'];
    use HasFactory;
}

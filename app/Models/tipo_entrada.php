<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_entrada extends Model
{
    protected $table='tipo_entrada';
    protected $fillable = ['tipo_entrada_nombre'];
    use HasFactory;
}

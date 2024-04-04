<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class disponibilidad extends Model
{
    protected $table='disponibilidad';
    protected $fillable = ['disponibilidad_nombre','disponibilidad_descripcion'];
    use HasFactory;
}

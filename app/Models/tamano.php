<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tamano extends Model
{
    protected $table='tamano';
    protected $fillable = ['tamano_nombre','tamano_descripcion'];
    use HasFactory;
}

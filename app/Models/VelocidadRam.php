<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VelocidadRam extends Model
{
    protected $table='velocidad_ram';
    protected $fillable = ['velocidad_ram_velocidad'];
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRam extends Model
{
    protected $table='tipo_ram';
    protected $fillable = ['tipo_ram_nombre'];
    use HasFactory;
}

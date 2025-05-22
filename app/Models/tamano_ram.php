<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tamano_ram extends Model
{
    protected $table='tamano_ram';
    protected $fillable = ['tamano_ram_nombre'];
    use HasFactory;
}

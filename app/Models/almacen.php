<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class almacen extends Model
{
    protected $table='almacen';
    protected $fillable = ['almacen_nombre','direccion_id'];
    use HasFactory;
}

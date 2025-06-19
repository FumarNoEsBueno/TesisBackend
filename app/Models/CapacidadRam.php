<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapacidadRam extends Model
{
    protected $table='capacidad_ram';
    protected $fillable = [
        'capacidad_ram_capacidad'];
    use HasFactory;
}

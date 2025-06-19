<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapacidadRam extends Model
{
    protected $table='CapacidadRam';
    protected $fillable = [
        'CapacidadRam_capacidad'];
    use HasFactory;
}

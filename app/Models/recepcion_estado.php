<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recepcion_estado extends Model
{
    protected $table='recepcion_estado';
    protected $fillable = ['recepcion_estado_nombre'];
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_periferico extends Model
{
    protected $table='tipo_periferico';
    protected $fillable = ['nombre_tipo_periferico'];
    use HasFactory;
}

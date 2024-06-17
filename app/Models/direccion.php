<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class direccion extends Model
{
    protected $table='direccion';
    protected $fillable = ['direccion_nombre',
        'ciudad_id',
        'users_id'];
    use HasFactory;
}

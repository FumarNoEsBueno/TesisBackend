<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marca extends Model
{
    protected $table='marca';
    protected $fillable = ['marca_nombre'];
    use HasFactory;
}

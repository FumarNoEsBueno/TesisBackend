<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ciudad extends Model
{
    protected $table='ciudad';
    protected $fillable = ['ciudad_nombre','provincia_id'];
    use HasFactory;
}

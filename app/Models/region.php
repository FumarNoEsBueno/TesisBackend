<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table='region';
    protected $fillable = ['region_nombre'];
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_metodo_despacho extends Model
{
    protected $table='metodo_despacho';
    protected $fillable = ['metodo_despacho_nombre','metodo_despacho_slug'];
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CelularFoto extends Model
{
    use HasFactory;

    protected $table = 'celular_foto';

    protected $fillable = [
        'celular_id',
        'ruta',
    ];

    public function celular()
    {
        return $this->belongsTo(\App\Models\Celular::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResiduoFoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'residuo_id',
        'nombre_archivo',
        'ruta',
    ];

    public function residuo()
    {
        return $this->belongsTo(Residuo::class);
    }
}

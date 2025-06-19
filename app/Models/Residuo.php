<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Residuo;
use App\Models\Residuo;

class Residuo extends Model 
{
    use HasFactory;

    protected $table = 'residuo';
    protected $fillable = [
        'nombre',
        'fecha',
        'hora',
        'descripcion',
        'peso',
        'almacen_id',
        'users_id'
    ];

    // Relación con almacen
    public function almacen()
    {
        return $this->belongsTo(almacen::class, 'almacen_id');
    }

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}

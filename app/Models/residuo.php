<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Almacen;
use App\Models\User;

class residuo extends Model 
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

    // Relación con Almacen
    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}

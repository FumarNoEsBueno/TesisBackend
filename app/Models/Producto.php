<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto'; // especifica el nombre exacto si no es plural

    protected $fillable = [
        'tipo',
        'id_objeto',
        'fecha',
        'hora',
        'descripcion',
        'peso',
        'almacen_id',
        'user_id',
        'estado_id',
        'id_objeto',
    ];

    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cable()
    {
        return $this->hasOne(Cable::class, 'id_objeto'); // o la relación inversa si `cable` tiene `producto_id`
    }

}

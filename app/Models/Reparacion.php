<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reparacion extends Model
{
    use HasFactory;

    protected $table = 'reparacion';

    protected $fillable = [
        'id_usuario',
        'tipo_objeto',
        'id_objeto',
        'detalle_reparacion',
        'observaciones',
        'fecha_reparacion',
    ];

    public function usuario() {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function producto() {
        return $this->belongsTo(Producto::class, 'id_objeto');
    }

    public function residuo() {
        return $this->belongsTo(Residuo::class, 'id_objeto');
    }

    public function herramienta() {
        return $this->belongsTo(Herramienta::class, 'id_objeto');
    }


    
}

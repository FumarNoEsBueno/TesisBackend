<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upgradeo extends Model
{
    use HasFactory;

    protected $table = 'upgradeo';

    protected $fillable = [
        'user_id',
        'tipo_objeto',
        'id_objeto',
        'detalle_upgradeo',
        'observaciones',
        'fecha_upgradeo',
    ];

    /**
     * Relaciones
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_objeto');
    }

    public function residuo()
    {
        return $this->belongsTo(Residuo::class, 'id_objeto');
    }

    public function herramienta()
    {
        return $this->belongsTo(Herramienta::class, 'id_objeto');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\RegistrarEnProducto;

class Cargador extends Model
{
    use HasFactory;
    use RegistrarEnProducto;

    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'compra_cargador')->withPivot('compra_cargador_cantidad');
    }

    protected $table='cargador';
    
    protected $fillable = 
    [
        'almacen_id'
    ];
    

    public function almacen()
    {
        return $this->belongsTo(\App\Models\Almacen::class, 'almacen_id');
    }
}
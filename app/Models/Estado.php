<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    
    protected $table = 'estado';  
    
    protected $fillable = ['estado_nombre','estado_descripcion'];

    use HasFactory;
    

    public function disco()
    {
        return $this->hasMany(DiscoDuro::class);
    }

    public function ram()
    {
        return $this->hasMany(Ram::class);
    }

    public function periferico()
    {
        return $this->hasMany(Periferico::class);
    }

    public function cable()
    {
        return $this->hasMany(Cable::class);
    }

    /**
     * Compras asociadas a este estado.
     * La FK en la tabla 'compra' es 'estado_compra_id'.
     */
    public function compras()
    {
        return $this->hasMany(Compra::class, 'estado_compra_id', 'id');
    }

    public function compra()
    {
        return $this->hasMany(Compra::class);
    }

     // Para ventas análogamente:
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'estado_venta_id', 'id');
    }

    public function venta()
    {
        return $this->hasMany(Venta::class);
    }

}

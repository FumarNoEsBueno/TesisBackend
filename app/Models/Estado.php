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
    

    public function discos()
    {
        return $this->hasMany(disco_duro::class);
    }

    public function rams()
    {
        return $this->hasMany(ram::class);
    }

    public function perifericos()
    {
        return $this->hasMany(periferico::class);
    }

    public function cables()
    {
        return $this->hasMany(cable::class);
    }

    public function compras()
    {
        return $this->hasMany(compra::class);
    }

    public function ventas()
    {
        return $this->hasMany(venta::class);
    }

}

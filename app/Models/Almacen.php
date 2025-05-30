<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class almacen extends Model
{
    protected $table='almacen';
    protected $fillable = ['almacen_nombre','direccion_id'];
    use HasFactory;   


    public function residuo()
    {
        return $this->hasMany(residuo::class, 'almacen_id');
    }
    public function ram()
    {
        return $this->hasMany(ram::class, 'almacen_id');
    }
    public function periferico()
    {
        return $this->hasMany(periferico::class, 'almacen_id');
    }
    public function cable()
    {
        return $this->hasMany(cable::class, 'almacen_id');
    }
    public function disco_duro()
    {
        return $this->hasMany(disco_duro::class, 'almacen_id');
    }    
    public function direccion()
    {
        return $this->belongsTo(direccion::class, 'direccion_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Almacen extends Model
{
    protected $table='almacen';
    protected $fillable = ['almacen_nombre','direccion_id'];
    use HasFactory;   


    public function residuo()
    {
        return $this->hasMany(Residuo::class, 'almacen_id');
    }
    public function ram()
    {
        return $this->hasMany(Ram::class, 'almacen_id');
    }
    public function periferico()
    {
        return $this->hasMany(Periferico::class, 'almacen_id');
    }
    public function cable()
    {
        return $this->hasMany(Cable::class, 'almacen_id');
    }
    public function disco_duro()
    {
        return $this->hasMany(DiscoDuro::class, 'almacen_id');
    }    
    public function direccion()
    {
        return $this->belongsTo(direccion::class, 'direccion_id');
    }
}

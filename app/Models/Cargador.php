<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargador extends Model
{
    public function compras()
    {
        return $this->belongsToMany(Compra::class, 'compra_cargador')->withPivot('compra_cargador_cantidad');
    }

    protected $table='cargador';
    protected $fillable = [
        
        ];
    use HasFactory;
}
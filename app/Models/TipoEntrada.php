<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEntrada extends Model
{
    public function discos()
    {
        return $this->hasMany(DiscoDuro::class);
    }

    protected $table='tipo_entrada';
    protected $fillable = ['tipo_entrada_nombre'];
    use HasFactory;
}

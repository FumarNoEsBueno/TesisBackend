<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class disponibilidad extends Model
{
    public function discos()
    {
        return $this->hasMany(disco_duro::class);
    }

    protected $table='disponibilidad';
    protected $fillable = ['disponibilidad_nombre','disponibilidad_descripcion'];
    use HasFactory;
}

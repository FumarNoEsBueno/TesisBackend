<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamano extends Model
{
    public function discos()
    {
        return $this->hasMany(DiscoDuro::class);
    }

    protected $table='tamano';
    protected $fillable = ['tamano_nombre','tamano_descripcion'];
    use HasFactory;
}

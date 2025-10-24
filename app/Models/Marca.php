<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    public function discos()
    {
        return $this->hasMany(DiscoDuro::class);
    }

    protected $table='marca';
    protected $fillable = ['marca_nombre'];
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class model_estado_compra extends Model
{
    public function compra()
    {
        return $this->hasMany(compra::class);
    }
    protected $table='estado_compra';
    protected $fillable = ['estado_compra_nombre','estado_compra_slug'];
    use HasFactory;
}

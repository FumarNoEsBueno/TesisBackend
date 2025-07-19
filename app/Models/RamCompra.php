<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RamCompra extends Model
{
    public function compra()
    {
        return $this->belongsToMany(Compra::class, 'compra_id');
    }
    public function ram()
    {
        return $this->belongsTo(Ram::class, 'ram_id');
    }

    protected $table='ram_compra';
    protected $fillable = ['ram_id',
        'ram_compra_descuento',
        'compra_id'];
    use HasFactory;
}

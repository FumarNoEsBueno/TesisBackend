<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraCable extends Model
{
    public function cable()
    {
        return $this->belongsTo(Cable::class, 'cable_id');
    }
    public function compra()
    {
        return $this->belongsTo(compra::class, 'compra_id');
    }

    protected $table='compra_cable';
    protected $fillable = [
        'compra_cable_cantidad',
        'compra_cable_descuento',
        'cable_id',
        'compra_id',
        ];
    use HasFactory;
}

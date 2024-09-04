<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class disco_duro_compra extends Model
{

    public function compra()
    {
        return $this->belongsTo(compra::class);
    }

    public function disco()
    {
        return $this->belongsTo(disco_duro::class);
    }

    protected $table='disco_duro_compra';
    protected $fillable = ['disco_duro_id',
        'disco_duro_compra_descuento',
        'compra_id'];
    use HasFactory;
}

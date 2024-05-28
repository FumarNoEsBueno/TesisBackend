<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compra extends Model
{
    public function discos()
    {
        return $this->hasMany(disco_duro::class);
    }

    public function metodo_pago()
    {
        return $this->belongsTo(model_metodo_pago::class);
    }
    public function metodo_despacho()
    {
        return $this->belongsTo(model_metodo_despacho::class);
    }
    public function estado_compra()
    {
        return $this->belongsTo(model_estado_compra::class);
    }

    protected $table='compra';
    protected $fillable = ['compra_codigo',
        'compra_email',
        'estado_compra_id',
        'direccion_id',
        'medoto_pago_id',
        'medoto_despacho_id'];
    use HasFactory;
}

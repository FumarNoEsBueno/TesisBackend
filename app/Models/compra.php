<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compra extends Model
{

    public function usuario()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function cables()
    {
        return $this->belongsToMany(cable::class, 'compra_cable', 'compra_id', 'cable_id')->withPivot('compra_cable_cantidad');
    }

    public function rams()
    {
        return $this->belongsToMany(ram::class, 'ram_compra', 'compra_id', 'ram_id');
    }

    public function perifericos()
    {
        return $this->belongsToMany(periferico::class, 'periferico_compra', 'compra_id', 'periferico_id');
    }

    public function discos()
    {
        return $this->belongsToMany(disco_duro::class, 'disco_duro_compra', 'compra_id', 'disco_duro_id');
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

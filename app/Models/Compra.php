<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cable()
    {
        return $this->belongsToMany(Cable::class, 'compra_cable', 'compra_id', 'cable_id')->withPivot('compra_cable_cantidad');
    }

    public function ram()
    {
        return $this->belongsToMany(Ram::class, 'ram_compra', 'compra_id', 'ram_id');
    }

    public function perifericos()
    {
        return $this->belongsToMany(Periferico::class, 'periferico_compra', 'compra_id', 'periferico_id');
    }

    public function discos()
    {
        return $this->belongsToMany(DiscoDuro::class, 'disco_duro_compra', 'compra_id', 'disco_duro_id');
    }

    public function metodo_pago()
    {
        return $this->belongsTo(MetodoPago::class);
    }

    public function MetodoDespacho()
    {
        return $this->belongsTo(MetodoDespacho::class);
    }
    public function EstadoCompra()
    {
        return $this->belongsTo(EstadoCompra::class);
    }

    protected $table='compra';
    protected $fillable = [
        'compra_email',
        'compra_costo',
        'compra_garantia',
        'estado_compra_id',
        'direccion_id',
        'medoto_pago_id',
        'medoto_despacho_id'];
    use HasFactory;
}

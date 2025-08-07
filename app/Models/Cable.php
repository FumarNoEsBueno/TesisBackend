<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\RegistrarEnProducto;

class Cable extends Model
{
    use RegistrarEnProducto;
    use HasFactory;
    protected $table = 'cable';

    protected $fillable = [
        'cable_nombre',
        'marca_id',
        'disponibilidad_id',
        'estado_id',
        'almacen_id',
        'tipo_entrada_1_id',
        'tipo_entrada_2_id',
        'largo',
        'peso',
        'test',
        'descripcion',
        'comentario',
        'cable_precio_unitario',
        'cable_precio_final',
        'cable_foto',
        'cable_descuento',
        'cable_destacado',
        'solicitud_recepcion_id',
    ];


    // Agregar nuevas relaciones
    public function tipoEntrada1()
    {
        return $this->belongsTo(TipoEntrada::class, 'tipo_entrada_1_id');
    }

    public function tipoEntrada2()
    {
        return $this->belongsTo(TipoEntrada::class, 'tipo_entrada_2_id');
    }    

    public function producto()
    {
        // Un cable TIENE UN producto asociado
        return $this->hasOne(Producto::class, 'id_objeto');
    }

    public function fotos()
    {
        return $this->hasMany(CableFoto::class);
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'almacen_id');
    }

}
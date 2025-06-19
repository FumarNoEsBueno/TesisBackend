<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cable extends Model
{
    use HasFactory;
    protected $table = 'cable';

    protected $fillable = [
        'cable_nombre',
        'marca_id',
        'disponibilidad_id',
        'comentario',  // Nuevo
        'estado_id',
        'test',        // Nuevo
        'largo',       // Nuevo
        'almacen_id',
        'descripcion',
        'cable_precio_unitario',  // Renombrado
        'cable_precio_final',     // Renombrado
        'cable_foto',
        'cable_descuento',
        'cable_destacado',
        'solicitud_recepcion_id',
        'tipo_entrada_id',
        'tipo_entrada_1_id',      // Nuevo
        'tipo_entrada_2_id'       // Nuevo
    ];

    // ... (las relaciones existentes se mantienen)

    // Agregar nuevas relaciones
    public function tipoEntrada1()
    {
        return $this->belongsTo(TipoEntrada::class, 'tipo_entrada_1_id');
    }

    public function tipoEntrada2()
    {
        return $this->belongsTo(TipoEntrada::class, 'tipo_entrada_2_id');
    }
    
    // Actualizar relación existente
    public function tipoEntrada()
    {
        return $this->belongsTo(TipoEntrada::class, 'tipo_entrada_id');
    }
}
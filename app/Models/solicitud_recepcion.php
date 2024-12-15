<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicitud_recepcion extends Model
{
    public function disco()
    {
        return $this->hasMany(disco_duro::class,'solicitud_recepcion_id', 'id');
    }
    public function ram()
    {
        return $this->hasMany(ram::class);
    }
    public function periferico()
    {
        return $this->hasMany(periferico::class);
    }
    public function cable()
    {
        return $this->hasMany(cable::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recepcion_estado()
    {
        return $this->belongsTo(recepcion_estado::class);
    }

    protected $table='solicitud_recepción';
    protected $fillable = ['solicitud_recepcion_volumen_aproximado',
        'solicitud_recepcion_peso_aproximado',
        'solicitud_recepcion_peso_calculado',
        'solicitud_recepcion_volumen_calculado',
        'solicitud_recepcion_codigo',
        'solicitud_recepcion_descripcion',
        'metodo_recepcion_id',
        'recepcion_estado_id',
        'user_id'];
    use HasFactory;
}

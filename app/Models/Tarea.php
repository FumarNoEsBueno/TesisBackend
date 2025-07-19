<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla en la base de datos.
     * Asegúrate de que tu tabla siga llamándose 'tarea'.
     */
    protected $table = 'tarea';

    /**
     * Campos asignables masivamente.
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo_trabajo',
        'nivel_urgencia',
    ];
}

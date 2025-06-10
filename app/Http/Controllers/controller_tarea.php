<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\tarea;
use Illuminate\Http\Request;

class controller_tarea extends Controller
{
    /**
     * Devuelve todas las tarea cuyo nivel_urgencia = 'alto'
     */
    public function urgente()
    {
        $tareaUrgente = tarea::where('nivel_urgencia', 'alto')
                              ->orderBy('created_at', 'desc')
                              ->get();

        return response()->json($tareaUrgente);
    }

    public function listar_sin_precio()
    {
    }

    public function tasar_producto(Request $request, $id)
    {
        $tarea = tarea::findOrFail($id);
        $tarea->precio = $request->input('precio');
        $tarea->save();

        return response()->json(['message' => 'Precio actualizado correctamente']);
    }
}

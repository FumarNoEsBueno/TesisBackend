<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\tarea;
use Illuminate\Http\Request;

class controller_tarea extends Controller
{
    /**
     * Devuelve todas las tareas cuyo nivel_urgencia = 'alto'
     */
    public function urgentes()
    {
        $tareasUrgentes = tarea::where('nivel_urgencia', 'alto')
                              ->orderBy('created_at', 'desc')
                              ->get();

        return response()->json($tareasUrgentes);
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

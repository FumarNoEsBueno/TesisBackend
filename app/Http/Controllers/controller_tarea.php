<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Tarea;


class controller_tarea extends Controller
{

    /**
     * Devuelve todas las tarea cuyo nivel_urgencia = 'alto'
     */
    public function urgente()
    {
        $tareaUrgente = Tarea::where('nivel_urgencia', 'alto')
                              ->orderBy('created_at', 'desc')
                              ->get();

        return response()->json($tareaUrgente);
    }

    /**
     * Devuelve todas las tarea ordenadas de mayor a menor urgencia
     */
    public function index(Request $request)
    {
        // Orden raw: primero alto, luego medio, luego bajo
        $tareas = DB::table('tarea')
            ->orderByRaw("FIELD(nivel_urgencia, 'alto', 'medio', 'bajo') DESC")
            ->get();

        return response()->json(['data' => $tareas], 200);
    }


    public function listar_sin_precio()
    {
    }

    public function tasar_producto(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->precio = $request->input('precio');
        $tarea->save();

        return response()->json(['message' => 'Precio actualizado correctamente']);
    }
}

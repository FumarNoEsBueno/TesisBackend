<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    // Obtener todas las tareas
    public function index()
    {
        return Tarea::with('usuarioRegistrador')->get();
    }

    // Obtener tareas por tipo
    public function getByType($tipo)
    {
        return Tarea::where('tipo_trabajo', $tipo)
            ->with('usuarioRegistrador')
            ->get();
    }

    // Obtener tareas del usuario actual
    public function getUserTasks()
    {
        $user = Auth::user();
        return Tarea::where('registrado_por', $user->id)
            ->with('usuarioRegistrador')
            ->get();
    }

    // Crear una nueva tarea
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'tipo_trabajo' => 'required|string',
            'nivel_urgencia' => 'required|string|in:bajo,medio,alto',
        ]);

        $tarea = new Tarea();
        $tarea->nombre = $request->nombre;
        $tarea->descripcion = $request->descripcion;
        $tarea->tipo_trabajo = $request->tipo_trabajo;
        $tarea->nivel_urgencia = $request->nivel_urgencia;
        $tarea->registrado_por = Auth::id(); // Asignar el usuario autenticado
        $tarea->save();

        // Cargar la relación para la respuesta
        $tarea->load('usuarioRegistrador');

        return response()->json($tarea, 201);
    }

    // Actualizar una tarea
    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);

        // Verificar que el usuario sea el creador
        if ($tarea->registrado_por !== Auth::id()) {
            return response()->json(['error' => 'No autorizado para modificar esta tarea'], 403);
        }

        $request->validate([
            'nombre' => 'string|max:255',
            'descripcion' => 'string',
            'tipo_trabajo' => 'string',
            'nivel_urgencia' => 'string|in:bajo,medio,alto',
        ]);

        $tarea->update($request->all());
        $tarea->load('usuarioRegistrador');

        return response()->json($tarea, 200);
    }

    // Eliminar una tarea
    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        
        // Verificar que el usuario sea el creador
        if ($tarea->registrado_por !== Auth::id()) {
            return response()->json(['error' => 'No autorizado para eliminar esta tarea'], 403);
        }

        $tarea->delete();
        return response()->json(null, 204);
    }

    // Obtener tareas urgentes
    public function obtenerTareaUrgente()
    {
        return Tarea::where('nivel_urgencia', 'alto')
            ->with('usuarioRegistrador')
            ->get();
    }
}
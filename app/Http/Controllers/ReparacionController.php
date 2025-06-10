<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reparacion;

class ReparacionController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Reparacion::orderBy('created_at', 'desc')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'usuario_id' => 'required|integer',
            'tipo_objeto' => 'required|string|in:residuo,producto,herramienta',
            'objeto_id' => 'required|integer',
            'tipo_reparacion' => 'required|string',
            'observaciones' => 'nullable|string',
            'fecha_reparacion' => 'required|date',
        ]);

        $reparacion = Reparacion::create($data);
        return response()->json(['message' => 'Reparación creada', 'data' => $reparacion], 201);
    }

    public function update(Request $request, $id)
    {
        $reparacion = Reparacion::findOrFail($id);
        $reparacion->update($request->all());

        return response()->json(['message' => 'Reparación actualizada', 'data' => $reparacion]);
    }

    public function destroy($id)
    {
        Reparacion::destroy($id);
        return response()->json(['message' => 'Reparación eliminada']);
    }
}

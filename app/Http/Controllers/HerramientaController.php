<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Herramienta;

class HerramientaController extends Controller
{
    public function index() {
        $herramientas = Herramienta::select('id','nombre')->get();
        return response()->json(['data'=>$herramientas]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'estado_id' => 'required|exists:estado,id',
            'peso' => 'nullable|numeric',
            'fecha' => 'nullable|date',
            'hora' => 'nullable',
            'user_id' => 'required|exists:users,id',
        ]);

        $herramienta = Herramienta::create($data);
        return response()->json(['message' => 'Herramienta creada', 'data' => $herramienta], 201);
    }

    public function update(Request $request, $id)
    {
        $herramienta = Herramienta::findOrFail($id);
        $herramienta->update($request->all());

        return response()->json(['message' => 'Herramienta actualizada', 'data' => $herramienta]);
    }

    public function destroy($id)
    {
        Herramienta::destroy($id);
        return response()->json(['message' => 'Herramienta eliminada']);
    }
}

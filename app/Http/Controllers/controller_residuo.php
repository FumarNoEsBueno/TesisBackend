<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\residuo;
use App\Models\almacen;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class controller_residuo extends Controller 
{
    public function almacen()
    {
        return $this->belongsTo(almacen::class, 'almacen_id');
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate
        ([
            'fecha'      => 'required|date',
            'hora'       => 'required|string',
            'nombre'     => 'required|string',
            'descripcion'=> 'required|string',
            'peso'       => 'required|numeric',
            'almacen_id' => 'required|exists:almacen,id',
            'user_id'    => 'required|exists:users,id',
        ]);

        $residuo = Residuo::create($validated);

        return response()->json([
            'message' => 'Residuo registrado correctamente',
            'data'    => $residuo
        ], 201);
    }

    public function get_all_residuos()
    {
        $residuos = residuo::with(['almacen', 'user'])->get();

        return response()->json([
            'message' => 'Lista de residuos obtenida correctamente',
            'data'    => $residuos
        ], 200);
    }

    public function get_residuo_by_id($id)
    {
        $residuo = residuo::with(['almacen', 'user'])->find($id);

        if (!$residuo) {
            return response()->json([
                'message' => 'Residuo no encontrado'
            ], 404);
        }

        return response()->json([
            'message' => 'Residuo encontrado',
            'data'    => $residuo
        ], 200);
    }

    public function update_residuo(Request $request, $id)
    {
        $residuo = residuo::find($id);

        if (!$residuo) {
            return response()->json([
                'message' => 'Residuo no encontrado'
            ], 404);
        }

        $validated = $request->validate
        ([
            'fecha'      => 'required|date',
            'hora'       => 'required|string',
            'nombre'     => 'required|string',
            'descripcion'=> 'required|string',
            'peso'       => 'required|numeric',
            'almacen_id' => 'required|exists:almacen,id',
            'user_id'    => 'required|exists:users,id',
        ]);

        $residuo->update($validated);

        return response()->json([
            'message' => 'Residuo actualizado correctamente',
            'data'    => $residuo
        ], 200);
    }

    public function delete_residuo($id)
    {
        $residuo = residuo::find($id);

        if (!$residuo) {
            return response()->json([
                'message' => 'Residuo no encontrado'
            ], 404);
        }

        $residuo->delete();

        return response()->json([
            'message' => 'Residuo eliminado correctamente'
        ], 200);
    }

}
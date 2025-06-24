<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residuo;
use App\Models\Almacen;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class controller_residuo extends Controller 
{
    /**
     * Crear un nuevo residuo
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'fecha'       => 'required|date',
            'hora'        => 'required|string',
            'nombre'      => 'required|string',
            'descripcion' => 'required|string',
            'peso'        => 'required|numeric',
            'almacen_id'  => 'required|exists:almacen,id',
            'user_id'    => 'required|exists:users,id',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => 'Datos inválidos',
                'errors'  => $validated->errors()
            ], 422);
        }

        $residuo = Residuo::create($validated->validated());

        return response()->json([
            'message' => 'Residuo registrado correctamente',
            'data'    => $residuo
        ], 201);
    }

    /**
     * Listar todos los residuo (con sus almacen y usuarios)
     */
    public function get_all_residuo()
    {
        $residuo = Residuo::with(['almacen', 'user'])->get();

        return response()->json([
            'message' => 'Lista de residuo obtenida correctamente',
            'data'    => $residuo
        ], 200);
    }

    /**
     * Obtener un solo residuo por ID
     */
    public function get_residuo_by_id($id)
    {
        $res = Residuo::with(['almacen', 'user'])->find($id);

        if (!$res) {
            return response()->json([
                'message' => 'Residuo no encontrado'
            ], 404);
        }

        return response()->json([
            'message' => 'Residuo encontrado',
            'data'    => $res
        ], 200);
    }

    /**
     * Actualizar un residuo existente
     */
    public function update_residuo(Request $request, $id)
    {
        $res = Residuo::find($id);
        if (!$res) {
            return response()->json([
                'message' => 'Residuo no encontrado'
            ], 404);
        }

        $validated = Validator::make($request->all(), [
            'fecha'       => 'required|date',
            'hora'        => 'required|string',
            'nombre'      => 'required|string',
            'descripcion' => 'required|string',
            'peso'        => 'required|numeric',
            'almacen_id'  => 'required|exists:almacen,id',
            'user_id'    => 'required|exists:users,id',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => 'Datos inválidos',
                'errors'  => $validated->errors()
            ], 422);
        }

        $res->update($validated->validated());

        return response()->json([
            'message' => 'Residuo actualizado correctamente',
            'data'    => $res
        ], 200);
    }

    /**
     * Eliminar un residuo
     */
    public function delete_residuo($id)
    {
        $res = Residuo::find($id);
        if (!$res) {
            return response()->json([
                'message' => 'Residuo no encontrado'
            ], 404);
        }

        $res->delete();

        return response()->json([
            'message' => 'Residuo eliminado correctamente'
        ], 200);
    }
}

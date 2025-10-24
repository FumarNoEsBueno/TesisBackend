<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Residuo;

class controller_cargador extends Controller 
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'     => 'required|string',
            'precio'      => 'required|string',

            'hora'       => 'required|string',            
            'descripcion'=> 'required|string',
            'peso'       => 'required|numeric',
            'almacen_id' => 'required|integer',
            'usuario'    => 'required|string',
        ]);

        $residuo = Residuo::create($validated);

        return response()->json([
            'message' => 'Residuo registrado correctamente',
            'data'    => $residuo
        ], 201);
    }

}
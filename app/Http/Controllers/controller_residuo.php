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

}
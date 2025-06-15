<?php

namespace App\Http\Controllers;

use App\Models\almacen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controller_almacen extends Controller
{
    public function getAllalmacen(Request $request)
    {
        \Log::info("getAllalmacen ejecutado"); // Log para debug

        // Obtener todos los registros de almacen
        $almacen = almacen::all();

        // Respuesta exitosa
        return response()->json([
            'message' => 'Lista de almacen',
            'data' => $almacen
        ], 200);
    }
    
}
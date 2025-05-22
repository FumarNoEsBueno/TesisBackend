<?php

namespace App\Http\Controllers;

use App\Models\almacen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controller_almacen extends Controller
{
    public function getAllAlmacenes(Request $request)
    {
        \Log::info("getAllAlmacenes ejecutado"); // Log para debug

        // Obtener todos los registros de almacenes
        $almacenes = almacen::all();

        // Respuesta exitosa
        return response()->json([
            'message' => 'Lista de almacenes',
            'data' => $almacenes
        ], 200);
    }
    
}
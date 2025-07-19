<?php

namespace App\Http\Controllers;

use App\Models\Almacen;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controller_almacen extends Controller
{
    public function get_all_almacen(Request $request)
    {
        \Log::info("get_all_almacen ejecutado"); // Log para debug

        // Obtener todos los registros de almacen
        $almacen = Almacen::all();

        // Respuesta exitosa
        return response()->json([
            'message' => 'Lista de almacen',
            'data' => $almacen
        ], 200);
    }
    
}
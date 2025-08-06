<?php

namespace App\Http\Controllers;

use App\Models\CableFoto;
use Illuminate\Http\Request;

class CableFotoController extends Controller
{
    public function index($id)
    {
        // 1. Buscar fotos en la base de datos
        $fotos = CableFoto::where('cable_id', $id)->get();
        
        // 2. Si no hay fotos, devolver array vacío
        if($fotos->isEmpty()) {
            return response()->json(['data' => []]);
        }
        
        // 3. Mapear resultados con URLs completas
        $fotosFormateadas = $fotos->map(function($foto) {
            return [
                'id' => $foto->id,
                'nombre_archivo' => $foto->nombre_archivo,
                'ruta' => $foto->ruta,
                'url' => $this->generarUrl($foto->ruta)
            ];
        });
        
        return response()->json(['data' => $fotosFormateadas]);
    }
    
    private function generarUrl($ruta)
    {
        // Si la ruta ya es una URL completa, devolverla directamente
        if (filter_var($ruta, FILTER_VALIDATE_URL)) {
            return $ruta;
        }
        
        // Generar URL completa para archivos locales
        return asset('storage/' . ltrim($ruta, '/'));
    }
}
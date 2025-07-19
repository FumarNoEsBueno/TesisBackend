<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CableFoto;

class ProductoFotoController extends Controller
{
    public function index($tipo, $id)
    {
        switch (strtolower($tipo)) {
            case 'cable':
                $fotos = CableFoto::where('cable_id', $id)->get();
                break;
            // Agrega más casos aquí cuando tengas otras tablas
            default:
                $fotos = collect();
                break;
        }

        // Transformamos para que retorne la URL
        return response()->json([
            'data' => $fotos->map(function($foto) {
                return [
                    'id' => $foto->id,
                    'nombre_archivo' => $foto->nombre_archivo,
                    'url' => $foto->url
                ];
            })
        ]);
    }
}

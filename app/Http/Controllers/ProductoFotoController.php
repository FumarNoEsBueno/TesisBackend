<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CableFoto;
use App\Models\CargadorFoto;


class ProductoFotoController extends Controller
{
    public function index($tipo, $id)
    {
        if (strtolower($tipo) === 'cable') {
            $fotos = CableFoto::where('cable_id', $id)->get();
        }
        else if (strtolower($tipo) === 'cargador') {
            $fotos = CargadorFoto::where('cargador_id', $id)->get();
        }
        else {
            $fotos = collect();
        }

        $data = $fotos->map(function($f) {
            return [
                'id'             => $f->id,
                'nombre_archivo' => $f->nombre_archivo,
                'ruta'           => $f->ruta,
                'url'            => asset("storage/{$f->ruta}")
            ];
        });

        return response()->json(['data' => $data]);
    }
}

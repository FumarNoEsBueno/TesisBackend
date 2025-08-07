<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CargadorFoto;

class CargadorFotoController extends Controller
{
    public function index($id)
    {
        $fotos = CargadorFoto::where('cargador_id', $id)->get()
                  ->map(fn($f) => [
                      'id' => $f->id,
                      'nombre_archivo' => $f->nombre_archivo,
                      'ruta' => $f->ruta,
                      'url' => asset("storage/{$f->ruta}")
                  ]);

        return response()->json(['data' => $fotos]);
    }
}

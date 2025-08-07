<?php

namespace App\Http\Controllers;

use App\Models\Celular;
use App\Models\CelularFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CelularFotoController extends Controller
{
    /**
     * Devuelve todas las fotos asociadas a un celular (GET).
     */
    public function index($id)
    {
        $fotos = CelularFoto::where('celular_id', $id)->get()
                  ->map(fn($f) => [
                      'id' => $f->id,
                      'nombre_archivo' => $f->nombre_archivo,
                      'ruta' => $f->ruta,
                      'url' => asset("storage/{$f->ruta}")
                  ]);

        return response()->json(['data' => $fotos]);
    }

    /**
     * Sube una nueva imagen para un celular (POST).
     */
    public function subir(Request $request, $id)
    {
        $request->validate([
            'imagen' => 'required|image|max:4096',
        ]);

        $celular = Celular::findOrFail($id);

        $archivo = $request->file('imagen');
        $nombreArchivo = uniqid('celular_') . '.' . $archivo->getClientOriginalExtension();
        // Almacenamos en storage/app/public/imagenes/celulares
        $ruta = $archivo->storeAs('public/imagenes/celulares', $nombreArchivo);

        // La ruta guardada en BD debe ser relativa a storage/, por ejemplo: imagenes/celulares/...
        $rutaBD = str_replace('public/', '', $ruta);

        $foto = new CelularFoto([
            'nombre_archivo' => $nombreArchivo,
            'ruta'           => $rutaBD,
        ]);

        $celular->fotos()->save($foto);

        // URL pública (p.ej. https://tu-dominio/storage/imagenes/celulares/xxx.jpg)
        $url = asset("storage/{$rutaBD}");

        return response()->json([
            'mensaje' => 'Imagen subida correctamente',
            'data'    => [
                'id'             => $foto->id,
                'nombre_archivo' => $nombreArchivo,
                'ruta'           => $rutaBD,
                'url'            => $url,
            ],
        ], 201);
    }
}

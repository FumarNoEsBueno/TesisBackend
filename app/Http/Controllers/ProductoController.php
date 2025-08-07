<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Producto;
use App\Models\Cable;
use App\Models\CableFoto;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::query();

        if ($request->filled('tipo_objeto')) {
            $query->where('tipo_objeto', $request->input('tipo_objeto'));
        }

        // Eager-load de estado y de la relación polimórfica + su almacén
        $productos = $query
            ->with(['estado', 'objeto.almacen'])
            ->get();

        // Mapeamos para inyectar almacen_id y almacen_nombre
        $data = $productos->map(function(Producto $p) {
            $obj = $p->objeto; // instancia de Cable o Cargador

            return [
                'id'              => $p->id,
                'tipo_objeto'     => $p->tipo_objeto,
                'id_objeto'       => $p->id_objeto,
                'descripcion'     => $p->descripcion,
                'peso'            => $p->peso,
                'fecha'           => $p->fecha,
                'hora'            => $p->hora,
                'estado_id'       => $p->estado_id,
                'estado_nombre'   => optional($p->estado)->estado_nombre,
                'almacen_id'      => optional($obj)->almacen_id,
                'almacen_nombre'  => optional($obj->almacen)->almacen_nombre ?? 'Desconocido',
            ];
        });

        return response()->json(['data' => $data]);
    }


    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validar campos requeridos
            $request->validate([
                'user_id' => 'required|integer',
                'estado_id' => 'required|integer',
                'marca_id' => 'required|integer',
                'tipo_entrada_1_id' => 'required|integer',
                'disponibilidad_id' => 'required|integer',
                'almacen_id' => 'required|integer',
                'cable_nombre' => 'required|string|max:255',
                'largo' => 'required|numeric|min:0.1',
                'peso' => 'required|numeric|min:0.01',
            ]);
            

            // Crear Producto
            $producto = Producto::create([
                'tipo_objeto' => 'cable',
                'id_objeto' => null,
                'user_id' => $request->input('user_id'),
                'estado_id' => $request->input('estado_id'),
                'fecha' => now()->toDateString(),
                'hora' => now()->toTimeString(),
                'descripcion' => $request->input('descripcion', ''),
                'peso' => $request->input('peso'),
            ]);

            // Crear Cable
            $cable = Cable::create([
                'id_objeto' => $producto->id,
                'cable_nombre' => $request->input('cable_nombre'),
                'estado_id' => $request->input('estado_id'),
                'marca_id' => $request->input('marca_id'),
                'tipo_entrada_1_id' => $request->input('tipo_entrada_1_id'),
                'tipo_entrada_2_id' => $request->input('tipo_entrada_2_id'),
                'disponibilidad_id' => $request->input('disponibilidad_id'),
                'almacen_id' => $request->input('almacen_id'),
                'comentario' => $request->input('comentario', ''),
                'test' => $request->boolean('test'),
                'largo' => $request->input('largo'),
                'cable_precio_unitario' => 0,
            ]);
            
            // Actualizar el producto con el id del cable
            $producto->update(['id_objeto' => $cable->id]);


            // Manejo de imágenes
            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $foto) {
                    // Validar tipo y tamaño
                    $validTypes = ['image/jpeg', 'image/png'];
                    $maxSize = 2 * 1024 * 1024; // 2MB
                    
                    if (!in_array($foto->getMimeType(), $validTypes)) {
                        continue; // Saltar archivos no válidos
                    }
                    
                    if ($foto->getSize() > $maxSize) {
                        continue; // Saltar archivos muy grandes
                    }

                    // Generar nombre único
                    $nombreArchivo = 'cable_' . $cable->id . '_' . time() . '_' . uniqid() . '.' . $foto->extension();
                    
                    // Guardar en storage
                    $path = $foto->storeAs('cables', $nombreArchivo, 'public');
                    
                    // Guardar referencia en BD
                    CableFoto::create([
                        'cable_id' => $cable->id,
                        'nombre_archivo' => $nombreArchivo,
                        'ruta' => $path
                    ]);
                }
            }


            DB::commit();

            return response()->json([
                'message' => 'Cable registrado correctamente',
                'producto_id' => $producto->id,
                'cable_id' => $cable->id
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al registrar el cable',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString() // Solo para desarrollo
            ], 500);
        }
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Producto;
use App\Models\Cable;
use App\Models\CableFoto;

class ProductoController extends Controller
{
    public function index()
    {
        // Cargar relaciones: estado y cable (si existe)
        $productos = Producto::with(['estado', 'cable'])
            ->get();

        // Mapear productos y agregar datos de cables si aplica
        $mappedProductos = $productos->map(function ($producto) {
            $item = [
                'id' => $producto->id,
                'tipo_objeto' => $producto->tipo_objeto,
                'id_objeto' => $producto->id_objeto,
                'descripcion' => $producto->descripcion,
                'peso' => $producto->peso,
                'fecha' => $producto->fecha,
                'hora' => $producto->hora,                
                'estado_nombre' => $producto->estado->estado_nombre,
            ];

            // Agregar campos específicos de cables
            if ($producto->tipo_objeto === 'cable' && $producto->cable) {
                $item['cable_nombre'] = $producto->cable->cable_nombre;
                $item['tipo_entrada_1_id'] = $producto->cable->tipo_entrada_1_id;
                $item['tipo_entrada_2_id'] = $producto->cable->tipo_entrada_2_id;
                $item['largo'] = $producto->cable->largo;
            }

            return $item;
        });

        return response()->json(['data' => $mappedProductos]);
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Cable;

class ProductoController extends Controller
{
    public function index()
    {
        // Cargar relaciones: almacen, estado y cable (si existe)
        $productos = Producto::with(['almacen', 'estado', 'cable'])
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
                'almacen_nombre' => $producto->almacen->almacen_nombre,
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


    // Otros métodos store, show, update, delete si se necesitan
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Crea el Producto sin el id_objeto
            $producto = Producto::create([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'tipo_objeto' => 'cable', // o lo que uses para diferenciar productos
                // otros campos del producto
            ]);

            // Crea el Cable con id_objeto = id del producto
            $cable = Cable::create([
                'id_objeto' => $producto->id,
                'cable_nombre' => $request->input('cable_nombre'),
                'estado_id' => $request->input('estado_id'),
                'marca_id' => $request->input('marca_id'),
                'tipo_entrada_1_id' => $request->input('tipo_entrada_1_id'),
                'tipo_entrada_2_id' => $request->input('tipo_entrada_2_id'),
                'disponibilidad_id' => $request->input('disponibilidad_id'),
                'almacen_id' => $request->input('almacen_id'),
                'comentario' => $request->input('comentario'),
                'test' => $request->input('test'),
                'largo' => $request->input('largo'),
                'cable_foto' => $request->input('cable_foto'),
                'peso' => $request->input('peso'),
            ]);

            // Actualiza el producto con el id del cable si es necesario
            $producto->id_objeto = $cable->id;
            $producto->save();

            DB::commit();

            return response()->json([
                'message' => 'Producto y Cable registrados correctamente.',
                'producto' => $producto,
                'cable' => $cable
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al registrar.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}

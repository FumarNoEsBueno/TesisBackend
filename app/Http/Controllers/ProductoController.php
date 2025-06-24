<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Cable;

class ProductoController extends Controller
{
    public function index() {
        $productos = DB::table('producto')
            ->join('estado', 'producto.estado_id', '=', 'estado.id')
            ->join('almacen', 'producto.almacen_id', '=', 'almacen.id')
            ->select(
                'producto.id',
                'producto.tipo',
                'producto.descripcion',
                'producto.peso',
                'producto.fecha',
                'producto.hora',
                'estado.estado_nombre',
                'almacen.almacen_nombre'
            )
            ->get();

        return response()->json(['data' => $productos]);
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
                'tipo' => 'cable', // o lo que uses para diferenciar productos
                // otros campos del producto
            ]);

            // Crea el Cable con id_objeto = id del producto
            $cable = Cable::create([
                'id_objeto' => $producto->id,
                'cable_nombre' => $request->input('cable_nombre'),
                'estado_id' => $request->input('estado_id'),
                'marca_id' => $request->input('marca_id'),
                'tipo_entrada_id' => $request->input('tipo_entrada_id'),
                'disponibilidad_id' => $request->input('disponibilidad_id'),
                'almacen_id' => $request->input('almacen_id'),
                'comentario' => $request->input('comentario'),
                'test' => $request->input('test'),
                'largo' => $request->input('largo'),
                'cable_foto' => $request->input('cable_foto')
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

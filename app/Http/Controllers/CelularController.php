<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Celular;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CelularController extends Controller
{
    /**
     * Crear un nuevo celular + producto asociado.
     */
    public function store(Request $request)
    {
        $request->validate([
            'modelo'     => 'required|string|max:255',
            'marca'      => 'required|string|max:255',
            'descripcion'=> 'nullable|string',
            'peso'       => 'nullable|numeric',
            'estado_id'  => 'required|integer',
            'almacen_id' => 'required|integer',
            // otros campos específicos de Celular…
        ]);

        DB::beginTransaction();
        try {
            // 1) Crear Producto
            $producto = Producto::create([
                'tipo_objeto' => 'celular',
                'id_objeto'   => 0,                   // temporal
                'descripcion' => $request->descripcion ?? $request->modelo,
                'peso'        => $request->peso   ?? 0,
                'user_id'     => auth()->id(),
                'estado_id'   => $request->estado_id,
                'fecha'       => now()->toDateString(),
                'hora'        => now()->toTimeString(),
            ]);

            // 2) Crear Celular referenciando el producto
            $celular = Celular::create([
                'producto_id'     => $producto->id,   // si tu tabla celular lo tiene
                'modelo'          => $request->modelo,
                'marca'           => $request->marca,
                'almacen_id'      => $request->almacen_id,
                'descripcion_punta'=> $request->descripcion ?? '',
                // … otros campos …
            ]);

            // 3) Actualizar id_objeto en producto
            $producto->update([
                'id_objeto' => $celular->id
            ]);

            DB::commit();

            return response()->json([
                'message'    => 'Celular y Producto creados correctamente',
                'producto'   => $producto,
                'celular'    => $celular,
            ], 201);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al crear Celular',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar celular + sync en producto.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion'=> 'nullable|string',
            'peso'       => 'nullable|numeric',
            'estado_id'  => 'nullable|integer',
            'almacen_id' => 'nullable|integer',
            // …
        ]);

        DB::beginTransaction();
        try {
            /** @var Celular $celular */
            $celular = Celular::findOrFail($id);

            // 1) Actualizar Celular
            $celular->update($request->only([
                'modelo', 'marca', 'almacen_id', 'descripcion_punta'
                // …
            ]));

            // 2) Actualizar Producto asociado
            $producto = Producto::where('tipo_objeto', 'celular')
                                ->where('id_objeto', $celular->id)
                                ->firstOrFail();

            $producto->update([
                'descripcion' => $request->descripcion ?? $celular->descripcion_punta,
                'peso'        => $request->peso        ?? $producto->peso,
                'estado_id'   => $request->estado_id   ?? $producto->estado_id,
            ]);

            DB::commit();

            return response()->json([
                'message'  => 'Celular y Producto actualizados',
                'producto' => $producto,
                'celular'  => $celular,
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error al actualizar Celular',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}

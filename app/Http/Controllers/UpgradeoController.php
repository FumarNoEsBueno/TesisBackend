<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Upgradeo;

class UpgradeoController extends Controller
{
    /**
     * Listar todos los upgradeos con nombre de objeto
     */
    public function index()
    {
        $items = DB::table('upgradeo')
            ->leftJoin('users', 'upgradeo.user_id', '=', 'users.id')
            ->select(
                'upgradeo.id',
                'upgradeo.user_id',
                'users.name as upgradeado_por',
                'upgradeo.tipo_objeto',
                'upgradeo.id_objeto',
                'upgradeo.detalle_upgradeo',
                'upgradeo.observaciones',
                'upgradeo.fecha_upgradeo'
            )
            ->get()
            ->map(function ($r) {
                $nombre = null;
                switch ($r->tipo_objeto) {
                    case 'herramienta':
                        $fila = DB::table('herramienta')->where('id', $r->id_objeto)->first();
                        $nombre = $fila->nombre ?? 'Revisar columna nombre en herramienta';
                        break;
                    case 'residuo':
                        $fila = DB::table('residuo')->where('id', $r->id_objeto)->first();
                        $nombre = $fila->nombre ?? 'Revisar columna nombre en residuo';
                        break;
                    case 'producto':
                        $prod = DB::table('producto')->where('id', $r->id_objeto)->first();
                        $nombre = $prod->descripcion ?? 'Producto sin descripción';
                        break;
                    default:
                        $nombre = 'Tipo no válido';
                }

                return [
                    'id' => $r->id,
                    'upgradeado_por' => $r->upgradeado_por,
                    'tipo_objeto' => $r->tipo_objeto,
                    'id_objeto' => $r->id_objeto,
                    'detalle_upgradeo' => $r->detalle_upgradeo,
                    'observaciones' => $r->observaciones,
                    'fecha_upgradeo' => $r->fecha_upgradeo,
                    'nombre_objeto' => $nombre,
                ];
            });

        return response()->json(['data' => $items]);
    }

    /**
     * Crear un nuevo upgradeo
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tipo_objeto' => 'required|string|in:residuo,producto,herramienta',
            'id_objeto' => 'required|integer',
            'detalle_upgradeo' => 'required|string',
            'observaciones' => 'nullable|string',
            'fecha_upgradeo' => 'required|date',
        ]);

        $data['user_id'] = $request->user()->id;

        $item = Upgradeo::create($data);
        return response()->json(['message' => 'upgradeo creado', 'data' => $item], 201);
    }

    /**
     * Actualizar un upgradeo existente
     */
    public function update(Request $request, $id)
    {
        $item = Upgradeo::findOrFail($id);
        $data = $request->validate([
            'detalle_upgradeo' => 'sometimes|string',
            'observaciones' => 'nullable|string',
            'fecha_upgradeo' => 'sometimes|date',
        ]);

        $item->update($data);
        return response()->json(['message' => 'upgradeo actualizado', 'data' => $item]);
    }

    /**
     * Eliminar un upgradeo
     */
    public function destroy($id)
    {
        $item = Upgradeo::find($id);
        if (!$item) {
            return response()->json(['error' => 'upgradeo no encontrado'], 404);
        }
        $item->delete();
        return response()->json(['mensaje' => 'upgradeo eliminado correctamente']);
    }
}
<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reparacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


class ReparacionController extends Controller
{
    public function index()
    {
        $reparaciones = DB::table('reparacion')
            ->leftJoin('users', 'reparacion.id_usuario', '=', 'users.id')
            ->select(
                'reparacion.id',
                'reparacion.id_usuario',
                'users.name as reparado_por',
                'reparacion.tipo_objeto',
                'reparacion.id_objeto',
                'reparacion.detalle_reparacion',
                'reparacion.observaciones',
                'reparacion.fecha_reparacion'
            )
            ->get()
            ->map(function ($r) {
                $nombre = null;

                switch ($r->tipo_objeto) {
                    case 'herramienta':
                        $fila = DB::table('herramienta')->where('id', $r->id_objeto)->first();
                        $nombre = $fila && isset($fila->nombre)
                            ? $fila->nombre
                            : 'Revisar columna nombre en herramienta';
                        break;

                    case 'residuo':
                        $fila = DB::table('residuo')->where('id', $r->id_objeto)->first();
                        $nombre = $fila && isset($fila->nombre)
                            ? $fila->nombre
                            : 'Revisar columna nombre en residuo';
                        break;

                    case 'producto':
                        // Lógica para producto: se basa en $fila->tipo y $r->id_objeto
                        $fila = DB::table('producto')->where('id', $r->id_objeto)->first();
                        if (!$fila) {
                            $nombre = 'Producto no encontrado';
                        } else {
                            // Suponemos que hay columna 'tipo' en producto con valores como 'disco duro', 'ram', 'periferico', etc.
                            $subtipo = $fila->tipo; // p.ej. 'disco duro' o 'ram'
                            // Normalizar para nombre de tabla: convertir espacios a guión bajo, minúsculas
                            $tablaSubtipo = Str::snake($subtipo); // e.g. "disco_duro", "ram", "periferico"
                            if (Schema::hasTable($tablaSubtipo)) {
                                // Obtener el registro en la tabla de subtipo:
                                $filaSub = DB::table($tablaSubtipo)->where('id', $fila->id_objeto)->first();
                                if (!$filaSub) {
                                    $nombre = ucfirst($subtipo) . ' no encontrado';
                                } else {
                                    // Intentar columnas de nombre en la tabla de subtipo:
                                    // 1) Si existe columna 'nombre' en esa tabla:
                                    if (Schema::hasColumn($tablaSubtipo, 'nombre') && isset($filaSub->nombre)) {
                                        $nombre = $filaSub->nombre ?: "Revisar columna nombre en {$tablaSubtipo}";
                                    } else {
                                        // 2) Buscar columnas que terminen en '_nombre'
                                        $cols = Schema::getColumnListing($tablaSubtipo);
                                        $colsNombre = array_filter($cols, fn($c) => Str::endsWith($c, '_nombre'));
                                        if (count($colsNombre) === 1) {
                                            $col = array_values($colsNombre)[0];
                                            $valor = $filaSub->$col;
                                            $nombre = $valor !== null && $valor !== '' 
                                                ? $valor 
                                                : "Revisar columna {$col} en {$tablaSubtipo}";
                                        } else {
                                            // No hay columna única de nombre, o hay varias
                                            $nombre = "Revisar columna nombre en producto (subtabla {$tablaSubtipo})";
                                        }
                                    }
                                }
                            } else {
                                $nombre = "Tabla {$tablaSubtipo} no existe para producto";
                            }
                        }
                        break;

                    default:
                        $nombre = 'Tipo no válido';
                }

                return [
                    'id' => $r->id,
                    'reparado_por' => $r->reparado_por,
                    'tipo_objeto' => $r->tipo_objeto,
                    'id_objeto' => $r->id_objeto,
                    'detalle_reparacion' => $r->detalle_reparacion,
                    'observaciones' => $r->observaciones,
                    'fecha_reparacion' => $r->fecha_reparacion,
                    'nombre_objeto' => $nombre,
                ];
            });

        return response()->json(['data' => $reparaciones]);
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'id_usuario' => 'required|integer|exists:users,id',
            'tipo_objeto' => 'required|string|in:residuo,producto,herramienta',
            'id_objeto' => 'required|integer',
            'detalle_reparacion' => 'required|string',
            'observaciones' => 'nullable|string',
            'fecha_reparacion' => 'required|date',
        ]);

        $reparacion = Reparacion::create($data);
        return response()->json(['message' => 'Reparación creada', 'data' => $reparacion], 201);
    }

    public function update(Request $request, $id)
    {
        $reparacion = Reparacion::findOrFail($id);
        $data = $request->validate([
            // En update, validar los campos que pueden cambiar. 
            // Si no cambias id_usuario, podrías omitirlo o incluirlo según tu lógica:
            'id_usuario' => 'sometimes|integer|exists:users,id',
            'tipo_objeto' => 'sometimes|string|in:residuo,producto,herramienta',
            'id_objeto' => 'sometimes|integer',
            'detalle_reparacion' => 'sometimes|string',
            'observaciones' => 'nullable|string',
            'fecha_reparacion' => 'sometimes|date',
        ]);
        $reparacion->update($data);
        return response()->json(['message' => 'Reparación actualizada', 'data' => $reparacion]);
    }

    public function destroy($id)
    {
        Reparacion::destroy($id);
        return response()->json(['message' => 'Reparación eliminada']);
    }
}

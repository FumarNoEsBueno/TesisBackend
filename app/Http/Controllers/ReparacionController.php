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
            ->leftJoin('users', 'reparacion.user_id', '=', 'users.id')
            ->select(
                'reparacion.id',
                'reparacion.user_id',
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
                        // Buscar registro en tabla producto según id_objeto de la reparación
                        $prod = DB::table('producto')->where('id', $r->id_objeto)->first();
                        if (!$prod) {
                            // No existe el producto referenciado
                            $nombre = "Producto con ID {$r->id_objeto} no encontrado";
                        } else {
                            // 1) Intentar subtipo según columna tipo
                            $subtipo = $prod->tipo; // ej. 'disco duro', 'ram', 'periferico', etc.
                            // Normalizar nombre de tabla: snake case, sin caracteres especiales
                            $tablaSubtipo = Str::snake($subtipo); // 'disco_duro', 'ram', 'periferico', etc.
                            if (Schema::hasTable($tablaSubtipo)) {
                                // Buscar registro en tabla de subtipo usando id_objeto de producto
                                // Suponemos que en la tabla de subtipo la PK es 'id', y el valor a buscar es $prod->id_objeto
                                $filaSub = DB::table($tablaSubtipo)->where('id', $prod->id_objeto)->first();
                                if (!$filaSub) {
                                    $nombre = ucfirst($subtipo) . " con ID {$prod->id_objeto} no encontrado";
                                } else {
                                    // Intentar extraer columna de nombre:
                                    if (Schema::hasColumn($tablaSubtipo, 'nombre') && isset($filaSub->nombre) && $filaSub->nombre !== null && $filaSub->nombre !== '') {
                                        $nombre = $filaSub->nombre;
                                    } else {
                                        // Buscar columna que termine en '_nombre'
                                        $cols = Schema::getColumnListing($tablaSubtipo);
                                        $colsNombre = array_filter($cols, fn($c) => Str::endsWith($c, '_nombre'));
                                        if (count($colsNombre) === 1) {
                                            $col = array_values($colsNombre)[0];
                                            $valor = $filaSub->$col;
                                            if ($valor !== null && $valor !== '') {
                                                $nombre = $valor;
                                            } else {
                                                $nombre = "Revisar columna {$col} en {$tablaSubtipo}";
                                            }
                                        } else {
                                            // Hay 0 o >1 columnas *_nombre; no sabemos cuál usar
                                            $nombre = "Revisar columna nombre en {$tablaSubtipo}";
                                        }
                                    }
                                }
                            } else {
                                // No existe tabla de subtipo. Usar fallback con datos de la tabla producto
                                if (isset($prod->descripcion) && trim($prod->descripcion) !== '') {
                                    // Por ejemplo, tomar la descripción o concatenar tipo+descripcion
                                    // Puedes formatear nombre como prefieras; ejemplo:
                                    $desc = trim($prod->descripcion);
                                    // Para no repetir demasiado, quizá recortar a 30 chars:
                                    $snippet = mb_strlen($desc) > 30 ? mb_substr($desc, 0, 30) . '...' : $desc;
                                    $nombre = ucfirst($prod->tipo) . ": " . $snippet;
                                } else {
                                    // Si no hay descripción, fallback a tipo o aviso
                                    if (isset($prod->tipo) && trim($prod->tipo) !== '') {
                                        $nombre = ucfirst($prod->tipo);
                                    } else {
                                        $nombre = 'Revisar columna descripción en producto';
                                    }
                                }
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
            'tipo_objeto' => 'required|string|in:residuo,producto,herramienta',
            'id_objeto' => 'required|integer',
            'detalle_reparacion' => 'required|string',
            'observaciones' => 'nullable|string',
            'fecha_reparacion' => 'required|date',
        ]);

        // Aquí auth()->id() NO debe ser null si la ruta está protegida y se envía token válido
        $data['user_id'] = $request->user()->id;

        $reparacion = Reparacion::create($data);
        return response()->json(['message' => 'Reparación creada', 'data' => $reparacion], 201);
    }


    public function update(Request $request, $id)
    {
        $reparacion = Reparacion::findOrFail($id);
        $data = $request->validate([
            // En update, validar los campos que pueden cambiar. 
            // Si no cambias user_id, podrías omitirlo o incluirlo según tu lógica:
            'user_id' => 'sometimes|integer|exists:users,id',
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
        $reparacion = \App\Models\Reparacion::find($id);

        if (!$reparacion) {
            return response()->json(['error' => 'Reparación no encontrada'], 404);
        }

        $reparacion->delete();

        return response()->json(['mensaje' => 'Reparación eliminada correctamente']);
    }

}

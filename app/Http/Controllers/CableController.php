<?php

namespace App\Http\Controllers;

use App\Models\cable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CableController extends Controller
{
    private $intervalo_precio = 10000;


    public function index()
    {
        $cables = Cable::select(
                'cable.id',
                'cable.cable_nombre',
                'cable.test',
                'cable.largo',
                'cable.descripcion',
                // nombres desde las tablas foráneas:
                'disponibilidad.disponibilidad_nombre',
                'almacen.almacen_nombre',
                'estado.estado_nombre',
                'marca.marca_nombre',
                'tipo_entrada.tipo_entrada_nombre'
            )
            // joins con nombres de tabla **singular** (tal como existen en tu BD)
            ->leftJoin('disponibilidad', 'cable.disponibilidad_id', '=', 'disponibilidad.id')
            ->leftJoin('almacen',       'cable.almacen_id',        '=', 'almacen.id')
            ->leftJoin('estado',        'cable.estado_id',         '=', 'estado.id')
            ->leftJoin('marca',         'cable.marca_id',          '=', 'marca.id')
            ->leftJoin('tipo_entrada',  'cable.tipo_entrada_id',   '=', 'tipo_entrada.id')
            ->get();

        return response()->json(['data' => $cables]);
    }


    public function get_cable_by_id(Request $request)
    {
        return cable::where('id','=',$request->id)->first();
    }

    public function get_every_cable(Request $request)
    {
        return cable::all()->select('id', 'cable_nombre');
    }

    public function delete_cable(Request $request)
    {
        $cable = cable::where('id', $request->id)
            ->first()
            ->delete();
        return $cable;
    }

    public function modify_cable(Request $request)
    {
        $cable = cable::where('id', $request->id)
            ->first()
            ->update([
            'cable_nombre' => $request->cable_nombre,
            'cable_cantidad' => $request->cable_cantidad,
            'cable_precio' =>$request->cable_precio,
            'cable_foto' => "cable_1.jpg",
            'cable_descuento' => $request->cable_descuento,
            'cable_destacado' => $request->cable_destacado,
            'disponibilidad_id' => $request->disponibilidad_id,
            'almacen_id' => $request->almacen_id,
            'solicitud_recepcion_id' => $request->solicitud_recepcion_id,
            'estado_id' => $request->estado_id,
            'marca_id' => $request->marca_id,
            'tipo_entrada_id' => $request->tipo_entrada_id,
            'tipo_periferico_id' => $request->tipo_periferico_id,
        ]);
        return $cable;
    }
    public function post_cable(Request $request)
    {

        $cable = cable::create([
            'cable_nombre' => $request->cable_nombre,
            'cable_cantidad' => $request->cable_cantidad,
            'cable_precio' =>$request->cable_precio,
            'cable_foto' => "cable_1.jpg",
            'cable_descuento' => $request->cable_descuento,
            'cable_destacado' => $request->cable_destacado,
            'disponibilidad_id' => $request->disponibilidad_id,
            'almacen_id' => $request->almacen_id,
            'estado_id' => $request->estado_id,
            'marca_id' => $request->marca_id,
            'tipo_entrada_id' => $request->tipo_entrada_id,
            'tipo_periferico_id' => $request->tipo_periferico_id,
        ]);
        return $cable;
    }
    public function get_all_cable(Request $request)
    {
        $query = DB::table('cable')
            ->join('disponibilidad', 'disponibilidad.id', '=', 'cable.disponibilidad_id')
            ->join('estado',        'estado.id',         '=', 'cable.estado_id')
            ->join('marca',         'marca.id',          '=', 'cable.marca_id')
            ->join('tipo_entrada',  'tipo_entrada.id',   '=', 'cable.tipo_entrada_id')
            ->join('almacen',       'almacen.id',        '=', 'cable.almacen_id')          // <-- nuevo join
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->select(
                'cable.id',
                'cable.cable_nombre',
                'cable.test',
                'cable.largo',
                'cable.descripcion',
                'cable.comentario',
                'cable.cable_foto',

                'disponibilidad.disponibilidad_nombre as disponibilidad_nombre',   // <-- nueva columna
                'almacen.almacen_nombre         as almacen_nombre',                // <-- nueva columna

                'estado.estado_nombre as estado_nombre',
                'tipo_entrada.tipo_entrada_nombre as tipo_entrada_nombre',
                'marca.marca_nombre           as marca_nombre'
            );
        

        // Paginamos 12 por página
        $cables = $query->paginate(12);

        return response()->json($cables);
    }

    public function getCablesPaginated(Request $request)
    {
        $cables = DB::table('cable')
            ->join('disponibilidad','disponibilidad.id','=','cable.disponibilidad_id')
            ->join('estado','estado.id','=','cable.estado_id')
            ->join('marca','marca.id','=','cable.marca_id')
            ->join('tipo_entrada','tipo_entrada.id','=','cable.tipo_entrada_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Reparacion pendiente')
            ->select('cable.id',
                'cable.cable_nombre',
                'cable.cable_cantidad',
                'cable.cable_precio',
                'cable.cable_foto',
                'cable.cable_descuento',
                'cable.cable_destacado',
                'estado.estado_nombre',
                'tipo_entrada.tipo_entrada_nombre',
                'marca.marca_nombre',
                );

        if($request->estado != null) $cables = $cables->whereIn('estado.id',$request->estado);
        if($request->marca != null) $cables = $cables->whereIn('marca.id',$request->marca);
        if($request->tipoEntrada != null) $cables = $cables->whereIn('tipo_entrada.id',$request->tipoEntrada);
        if($request->precio != null){
            foreach ($request->precio as $precio) {
                $cables = $cables->where('cable_precio','>', ($precio - 1) * $this->intervalo_precio);
                $cables = $cables->where('cable_precio','<', $precio * $this->intervalo_precio);
            }
        }


        $cables = $cables->paginate(12);
        return $cables;
    }

    public function get_cable_recomendado(Request $request)
    {
        $cables = DB::table('cable')
            ->join('disponibilidad','disponibilidad.id','=','cable.disponibilidad_id')
            ->join('estado','estado.id','=','cable.estado_id')
            ->join('marca','marca.id','=','cable.marca_id')
            ->join('tipo_entrada','tipo_entrada.id','=','cable.tipo_entrada_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Reparacion pendiente')
            ->where('estado.estado_nombre', '!=', 'Para repuesto')
            ->where('estado.estado_nombre', '!=', 'Por revisar')
            ->where('tipo_entrada.tipo_entrada_nombre', '=', $request->tipoEntrada)
            ->select('cable.id',
                'cable.cable_nombre',
                'cable.cable_cantidad',
                'cable.cable_precio',
                'cable.cable_foto',
                'cable.cable_descuento',
                'cable.cable_destacado',
                'estado.estado_nombre',
                'tipo_entrada.tipo_entrada_nombre',
                'marca.marca_nombre',
                );


        $cables = $cables->limit(3)->get();
        return $cables;
    }
}

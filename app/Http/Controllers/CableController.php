<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use App\Models\Producto;
use App\Models\Almacen;
use App\Models\Disponibilidad;
use App\Models\Estado;
use App\Models\Marca;
use App\Models\TipoEntrada;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CableController extends Controller
{
    private $intervalo_precio = 10000;

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cable_nombre' => 'required|string|max:255',
            'marca_id' => 'required|integer',
            'disponibilidad_id' => 'required|integer',
            'estado_id' => 'required|integer',
            'almacen_id' => 'required|integer',
            'tipo_entrada_id' => 'required|integer',
            'largo' => 'required|numeric',
            'peso' => 'required|numeric',
            'tipo' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        
        // Asegurar valores numéricos
        $intFields = ['marca_id', 'disponibilidad_id', 'estado_id', 'almacen_id', 'tipo_entrada_id'];
        foreach ($intFields as $field) {
            $data[$field] = (int) $data[$field];
        }
        
        // Crear cable
        $cable = Cable::create([
            'cable_nombre' => $data['cable_nombre'],
            'marca_id' => $data['marca_id'],
            'disponibilidad_id' => $data['disponibilidad_id'],
            'estado_id' => $data['estado_id'],
            'almacen_id' => $data['almacen_id'],
            'tipo_entrada_id' => $data['tipo_entrada_id'],
            'largo' => $data['largo'],
            'descripcion' => $data['descripcion'] ?? '',
            'comentario' => $data['comentario'] ?? '',
            'cable_precio_unitario' => 0,
            'cable_precio_final' => 0,
            'cable_foto' => 'default.jpg'
        ]);

        // Crear producto asociado
        $producto = Producto::create([
            'tipo' => $data['tipo'],
            'id_objeto' => $cable->id,
            'fecha' => now()->format('Y-m-d'),
            'hora' => now()->format('H:i:s'),
            'descripcion' => $data['descripcion'] ?? 'Cable registrado',
            'peso' => $data['peso'],
            'almacen_id' => $data['almacen_id'],
            'user_id' => $request->user()->id,
            'estado_id' => $data['estado_id']
        ]);

        return response()->json([
            'cable' => $cable,
            'producto' => $producto
        ], 201);
    }


    public function show($id)
    {
        return Cable::findOrFail($id);
    }


    public function index()
    {
        $cable = Cable::select(
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

        return response()->json(['data' => $cable]);
    }


    public function get_cable_by_id(Request $request)
    {
        return Cable::where('id','=',$request->id)->first();
    }

    public function get_every_cable(Request $request)
    {
        return Cable::all()->select('id', 'cable_nombre');
    }

    public function delete_cable(Request $request)
    {
        $cable = Cable::where('id', $request->id)
            ->first()
            ->delete();
        return $cable;
    }

    public function modify_cable(Request $request)
    {
        $cable = Cable::where('id', $request->id)
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

        $cable = Cable::create([
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
        $cable = $query->paginate(12);

        return response()->json($cable);
    }

    public function getCablesPaginated(Request $request)
    {
        $cable = DB::table('cable')
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

        if($request->estado != null) $cable = $cable->whereIn('estado.id',$request->estado);
        if($request->marca != null) $cable = $cable->whereIn('marca.id',$request->marca);
        if($request->tipoEntrada != null) $cable = $cable->whereIn('tipo_entrada.id',$request->tipoEntrada);
        if($request->precio != null){
            foreach ($request->precio as $precio) {
                $cable = $cable->where('cable_precio','>', ($precio - 1) * $this->intervalo_precio);
                $cable = $cable->where('cable_precio','<', $precio * $this->intervalo_precio);
            }
        }


        $cable = $cable->paginate(12);
        return $cable;
    }

    public function get_cable_recomendado(Request $request)
    {
        $cable = DB::table('cable')
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


        $cable = $cable->limit(3)->get();
        return $cable;
    }
}

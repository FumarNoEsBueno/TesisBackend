<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CableController extends Controller
{
    private $intervalo_precio = 10000;

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'cable_nombre'        => 'required|string|max:255',
            'marca_id'            => 'required|integer',
            'disponibilidad_id'   => 'required|integer',
            'estado_id'           => 'required|integer',
            'almacen_id'          => 'required|integer',
            'tipo_entrada_1_id'   => 'required|integer',
            'tipo_entrada_2_id'   => 'nullable|integer',
            'largo'               => 'required|numeric',
            'peso'                => 'required|numeric',
            'test'                => 'required|boolean',
            'descripcion'         => 'nullable|string',
            'comentario'          => 'nullable|string',
            'tipo_objeto'         => 'required|string'        // <-- validación añadida
        ]);

        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()], 422);
        }

        $d = $v->validated();
        foreach (['marca_id','disponibilidad_id','estado_id','almacen_id','tipo_entrada_1_id','tipo_entrada_2_id'] as $f) {
            if (isset($d[$f])) $d[$f] = (int)$d[$f];
        }
        $d['test'] = (bool)$d['test'];

        // Crear registro de Cable
        $cable = Cable::create([
            'cable_nombre'           => $d['cable_nombre'],
            'marca_id'               => $d['marca_id'],
            'disponibilidad_id'      => $d['disponibilidad_id'],
            'estado_id'              => $d['estado_id'],
            'almacen_id'             => $d['almacen_id'],
            'tipo_entrada_1_id'      => $d['tipo_entrada_1_id'],
            'tipo_entrada_2_id'      => $d['tipo_entrada_2_id'] ?? null,
            'largo'                  => $d['largo'],
            'peso'                   => $d['peso'],
            'test'                   => $d['test'],
            'descripcion'            => $d['descripcion'] ?? '',
            'comentario'             => $d['comentario'] ?? '',
            'cable_precio_unitario'  => 0,
            'cable_precio_final'     => 0,
            'cable_foto'             => 'desconocido.jpg',
            'cable_descuento'        => 0,
            'cable_destacado'        => 0,
            'solicitud_recepcion_id' => null,
        ]);

        // Crear registro de Producto asociado
        $producto = Producto::create([
            'tipo_objeto' => $d['tipo_objeto'],  // <-- aquí se usa el campo correcto
            'id_objeto'   => $cable->id,
            'fecha'       => now()->toDateString(),
            'hora'        => now()->toTimeString(),
            'descripcion' => $d['descripcion'] ?? 'Cable registrado',
            'peso'        => $d['peso'],
            'almacen_id'  => $d['almacen_id'],
            'user_id'     => $request->user()->id,
            'estado_id'   => $d['estado_id'],
        ]);

        return response()->json(compact('cable','producto'), 201);
    }

    public function show($id)
    {
        return Cable::findOrFail($id);
    }

    public function index()
    {
        $c = Cable::select(
                'cable.id',
                'cable.cable_nombre',
                'cable.test',
                'cable.largo',
                'cable.peso',
                'cable.descripcion',
                'disponibilidad.disponibilidad_nombre',
                'almacen.almacen_nombre',
                'estado.estado_nombre',
                'marca.marca_nombre',
                'te1.tipo_entrada_nombre as entrada1',
                'te2.tipo_entrada_nombre as entrada2'
            )
            ->leftJoin('disponibilidad','cable.disponibilidad_id','=','disponibilidad.id')
            ->leftJoin('almacen',      'cable.almacen_id','=','almacen.id')
            ->leftJoin('estado',       'cable.estado_id','=','estado.id')
            ->leftJoin('marca',        'cable.marca_id','=','marca.id')
            ->leftJoin('tipo_entrada as te1','cable.tipo_entrada_1_id','=','te1.id')
            ->leftJoin('tipo_entrada as te2','cable.tipo_entrada_2_id','=','te2.id')
            ->get();

        return response()->json(['data'=>$c]);
    }


    public function get_cable_by_id(Request $req)
    {
        return Cable::findOrFail($req->id);
    }

    public function get_every_cable(Request $req)
    {
        return Cable::select('id','cable_nombre')->get();
    }

    public function delete_cable(Request $req)
    {
        return Cable::destroy($req->id);
    }

    public function modify_cable(Request $request)
    {
        $up = $request->validate([
            'id'                   => 'required|integer',
            'cable_nombre'         => 'sometimes|string',
            'disponibilidad_id'    => 'sometimes|integer',
            'almacen_id'           => 'sometimes|integer',
            'estado_id'            => 'sometimes|integer',
            'marca_id'             => 'sometimes|integer',
            'tipo_entrada_1_id'    => 'sometimes|integer',
            'tipo_entrada_2_id'    => 'sometimes|integer',
            'largo'                => 'sometimes|numeric',
            'peso'                 => 'sometimes|numeric',
            'test'                 => 'sometimes|boolean',
            'comentario'           => 'sometimes|string',
            'descripcion'          => 'sometimes|string',
            'cable_descuento'      => 'sometimes|numeric',
            'cable_destacado'      => 'sometimes|boolean',
        ]);

        $cable = Cable::findOrFail($up['id']);
        unset($up['id']);
        $cable->update($up);
        return response()->json($cable);
    }

    public function get_all_cable(Request $req)
    {
        $q = DB::table('cable')
            ->join('disponibilidad','disponibilidad.id','=','cable.disponibilidad_id')
            ->join('estado',       'estado.id','=','cable.estado_id')
            ->join('marca',        'marca.id','=','cable.marca_id')
            ->join('tipo_entrada as te1','te1.id','=','cable.tipo_entrada_1_id')
            ->join('tipo_entrada as te2','te2.id','=','cable.tipo_entrada_2_id')
            ->join('almacen',      'almacen.id','=','cable.almacen_id')
            ->where('disponibilidad.disponibilidad_nombre','!=','Vendido')
            ->select(
                'cable.id','cable.cable_nombre','cable.test','cable.largo',
                'cable.peso','cable.descripcion','cable.comentario',
                'cable.cable_foto',
                'disponibilidad.disponibilidad_nombre as disponibilidad_nombre',
                'almacen.almacen_nombre as almacen_nombre',
                'estado.estado_nombre as estado_nombre',
                'te1.tipo_entrada_nombre as entrada1',
                'te2.tipo_entrada_nombre as entrada2',
                'marca.marca_nombre'
            )
            ->paginate(12);

        return response()->json($q);
    }

    public function getCablesPaginated(Request $request)
    {
        $q = DB::table('cable')
            ->join('disponibilidad','disponibilidad.id','=','cable.disponibilidad_id')
            ->join('estado',       'estado.id','=','cable.estado_id')
            ->join('marca',        'marca.id','=','cable.marca_id')
            ->join('tipo_entrada as te1','te1.id','=','cable.tipo_entrada_1_id')
            ->join('tipo_entrada as te2','te2.id','=','cable.tipo_entrada_2_id')
            ->whereNotIn('disponibilidad.disponibilidad_nombre',['Vendido','Reparacion pendiente'])
            ->select(
                'cable.id','cable.cable_nombre','cable.test',
                'cable.largo','cable.peso','cable.cable_foto',
                'cable.cable_descuento','cable.cable_destacado',
                'estado.estado_nombre','te1.tipo_entrada_nombre as entrada1',
                'te2.tipo_entrada_nombre as entrada2','marca.marca_nombre'
            );

        if ($request->estado)        $q->whereIn('estado.id',$request->estado);
        if ($request->marca)         $q->whereIn('marca.id',$request->marca);
        if ($request->tipoEntrada)   $q->whereIn('te1.id',$request->tipoEntrada);
        if ($request->precio) {
            foreach ($request->precio as $p) {
                $q->where('cable_precio_final','>',($p-1)*$this->intervalo_precio)
                  ->where('cable_precio_final','<',$p*$this->intervalo_precio);
            }
        }

        return $q->paginate(12);
    }

    public function get_cable_recomendado(Request $request)
    {
        $q = DB::table('cable')
            ->join('disponibilidad','disponibilidad.id','=','cable.disponibilidad_id')
            ->join('estado',       'estado.id','=','cable.estado_id')
            ->join('marca',        'marca.id','=','cable.marca_id')
            ->join('tipo_entrada as te1','te1.id','=','cable.tipo_entrada_1_id')
            ->join('tipo_entrada as te2','te2.id','=','cable.tipo_entrada_2_id')
            ->whereNotIn('disponibilidad.disponibilidad_nombre',['Vendido','Reparacion pendiente'])
            ->whereNotIn('estado.estado_nombre',['Para repuesto','Por revisar'])
            ->where('te1.tipo_entrada_nombre',$request->tipoEntrada)
            ->select(
                'cable.id','cable.cable_nombre','cable.test',
                'cable.largo','cable.peso','cable.cable_foto',
                'cable.cable_descuento','cable.cable_destacado',
                'estado.estado_nombre','te1.tipo_entrada_nombre as entrada1',
                'te2.tipo_entrada_nombre as entrada2','marca.marca_nombre'
            )
            ->limit(3)
            ->get();

        return response()->json($q);
    }
}

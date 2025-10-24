<?php

namespace App\Http\Controllers;

use App\Models\periferico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controller_periferico extends Controller
{
    private $intervalo_precio = 10000;

    public function get_periferico_by_id(Request $request)
    {
        return Periferico::where('id','=',$request->id)->first();
    }

    public function get_every_periferico(Request $request)
    {
        return Periferico::all()->select('id', 'periferico_nombre');
    }

    public function delete_periferico(Request $request)
    {
        $periferico = Periferico::where('id', $request->id)
            ->first()
            ->delete();
        return $periferico;
    }

    public function modify_periferico(Request $request)
    {
        $periferico = Periferico::where('id', $request->id)
            ->first()
            ->update([
            'periferico_nombre' => $request->periferico_nombre,
            'periferico_foto' => "periferico1.jgp",
            'periferico_descripcion' =>$request->periferico_descripcion,
            'periferico_precio' => $request->periferico_precio,
            'disponibilidad_id' => $request->disponibilidad_id,
            'periferico_descuento' => $request->periferico_descuento,
            'periferico_destacado' => $request->periferico_destacado,
            'almacen_id' => $request->almacen_id,
            'solicitud_recepcion_id' => $request->solicitud_recepcion_id,
            'estado_id' => $request->estado_id,
            'marca_id' => $request->marca_id,
            'tipo_entrada_id' => $request->tipo_entrada_id,
            'tipo_periferico_id' => $request->tipo_periferico_id,
        ]);
        return $periferico;
    }

    public function post_periferico(Request $request)
    {

        $periferico = Periferico::create([
            'periferico_nombre' => $request->periferico_nombre,
            'periferico_foto' => "periferico1.jgp",
            'periferico_descripcion' =>$request->periferico_descripcion,
            'periferico_precio' => $request->periferico_precio,
            'disponibilidad_id' => $request->disponibilidad_id,
            'periferico_descuento' => $request->periferico_descuento,
            'periferico_destacado' => $request->periferico_destacado,
            'almacen_id' => $request->almacen_id,
            'estado_id' => $request->estado_id,
            'marca_id' => $request->marca_id,
            'tipo_entrada_id' => $request->tipo_entrada_id,
            'tipo_periferico_id' => $request->tipo_periferico_id,
        ]);
        return $periferico;
    }

    public function get_all_perifericos(Request $request)
    {
        $perifericos = DB::table('periferico')
            ->join('disponibilidad','disponibilidad.id','=','periferico.disponibilidad_id')
            ->join('estado','estado.id','=','periferico.estado_id')
            ->join('marca','marca.id','=','periferico.marca_id')
            ->join('tipo_entrada','tipo_entrada.id','=','periferico.tipo_entrada_id')
            ->join('tipo_periferico','tipo_periferico.id','=','periferico.tipo_periferico_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->select('periferico.id',
                'periferico.periferico_nombre',
                'periferico.periferico_precio',
                'periferico.periferico_foto',
                'periferico.periferico_descuento',
                'periferico.periferico_destacado',
                'disponibilidad.disponibilidad_nombre',
                'disponibilidad.disponibilidad_descripcion',
                'tipo_periferico.nombre_tipo_periferico',
                'tipo_entrada.tipo_entrada_nombre',
                'estado.estado_nombre',
                'marca.marca_nombre');

        if($request->estado != null) $perifericos = $perifericos->whereIn('estado.id',$request->estado);
        if($request->marca != null) $perifericos = $perifericos->whereIn('marca.id',$request->marca);
        if($request->tipoPeriferico != null) $perifericos = $perifericos->whereIn('tipo_periferico.id',$request->tipoPeriferico);
        if($request->tipoEntrada != null) $perifericos = $perifericos->whereIn('tipo_entrada.id',$request->tipoEntrada);
        if($request->precio != null){
            foreach ($request->precio as $precio) {
                $perifericos = $perifericos->where('periferico_precio','>', ($precio - 1) * $this->intervalo_precio);
                $perifericos = $perifericos->where('periferico_precio','<', $precio * $this->intervalo_precio);
            }
        }

        $perifericos = $perifericos->paginate(12);
        return $perifericos;
    }

    public function perifericosPaginated(Request $request)
    {
        $perifericos = DB::table('periferico')
            ->join('disponibilidad','disponibilidad.id','=','periferico.disponibilidad_id')
            ->join('estado','estado.id','=','periferico.estado_id')
            ->join('marca','marca.id','=','periferico.marca_id')
            ->join('tipo_entrada','tipo_entrada.id','=','periferico.tipo_entrada_id')
            ->join('tipo_periferico','tipo_periferico.id','=','periferico.tipo_periferico_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Reparacion pendiente')
            ->select('periferico.id',
                'periferico.periferico_nombre',
                'periferico.periferico_precio',
                'periferico.periferico_foto',
                'periferico.periferico_descuento',
                'periferico.periferico_destacado',
                'disponibilidad.disponibilidad_nombre',
                'disponibilidad.disponibilidad_descripcion',
                'tipo_periferico.nombre_tipo_periferico',
                'tipo_entrada.tipo_entrada_nombre',
                'estado.estado_nombre',
                'marca.marca_nombre');

        if($request->estado != null) $perifericos = $perifericos->whereIn('estado.id',$request->estado);
        if($request->marca != null) $perifericos = $perifericos->whereIn('marca.id',$request->marca);
        if($request->tipoPeriferico != null) $perifericos = $perifericos->whereIn('tipo_periferico.id',$request->tipoPeriferico);
        if($request->tipoEntrada != null) $perifericos = $perifericos->whereIn('tipo_entrada.id',$request->tipoEntrada);
        if($request->precio != null){
            foreach ($request->precio as $precio) {
                $perifericos = $perifericos->where('periferico_precio','>', ($precio - 1) * $this->intervalo_precio);
                $perifericos = $perifericos->where('periferico_precio','<', $precio * $this->intervalo_precio);
            }
        }

        $perifericos = $perifericos->paginate(12);
        return $perifericos;
    }
}

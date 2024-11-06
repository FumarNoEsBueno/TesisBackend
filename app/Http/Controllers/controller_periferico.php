<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controller_periferico extends Controller
{
    private $intervalo_precio = 10000;

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

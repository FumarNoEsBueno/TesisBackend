<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controller_periferico extends Controller
{
    public function perifericosPaginated(Request $request)
    {
        $perifericos = DB::table('periferico')
            ->join('disponibilidad','disponibilidad.id','=','periferico.disponibilidad_id')
            ->join('estado','estado.id','=','periferico.estado_id')
            ->join('marca','marca.id','=','periferico.marca_id')
            ->join('tipo_entrada','tipo_entrada.id','=','periferico.tipo_entrada_id')
            ->join('tipo_periferico','tipo_periferico.id','=','periferico.tipo_periferico_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->whereNull('compra_id')
            ->select('periferico.id',
                'periferico.periferico_nombre',
                'periferico.periferico_precio',
                'periferico.periferico_foto',
                'disponibilidad.disponibilidad_nombre',
                'disponibilidad.disponibilidad_descripcion',
                'tipo_periferico.nombre_tipo_periferico',
                'tipo_entrada.tipo_entrada_nombre',
                'estado.estado_nombre',
                'marca.marca_nombre');

        if($request->disponibilidad != null) $perifericos = $perifericos->whereIn('disponibilidad.id',$request->disponibilidad);
        if($request->estado != null) $perifericos = $perifericos->whereIn('estado.id',$request->estado);
        if($request->marca != null) $perifericos = $perifericos->whereIn('marca.id',$request->marca);
        if($request->tipo_periferico != null) $perifericos = $perifericos->whereIn('tipo_periferico.id',$request->tipo_periferico);
        if($request->tipo_entrada != null) $perifericos = $perifericos->whereIn('tipo_entrada.id',$request->tipo_entrada);

        $perifericos = $perifericos->paginate(12);
        return $perifericos;
    }
}

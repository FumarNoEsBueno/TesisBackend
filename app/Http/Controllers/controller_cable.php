<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controller_cable extends Controller
{
    private $intervalo_precio = 10000;

    public function get_all_cable(Request $request)
    {
        $cables = DB::table('cable')
            ->join('disponibilidad','disponibilidad.id','=','cable.disponibilidad_id')
            ->join('estado','estado.id','=','cable.estado_id')
            ->join('marca','marca.id','=','cable.marca_id')
            ->join('tipo_entrada','tipo_entrada.id','=','cable.tipo_entrada_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->leftJoin('descuento','descuento.id','=','cable.descuento_id')
            ->select('cable.id',
                'cable.cable_nombre',
                'cable.cable_cantidad',
                'cable.cable_precio',
                'cable.cable_foto',
                'cable.descuento_id',
                'estado.estado_nombre',
                'descuento.descuento_porcentaje',
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
                'cable.descuento_id',
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
                'cable.descuento_id',
                'estado.estado_nombre',
                'tipo_entrada.tipo_entrada_nombre',
                'marca.marca_nombre',
                );


        $cables = $cables->limit(3)->get();
        return $cables;
    }
}

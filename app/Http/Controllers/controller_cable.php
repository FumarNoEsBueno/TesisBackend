<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controller_cable extends Controller
{
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


        $cables = $cables->paginate(12);
        return $cables;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controller_ram extends Controller
{
    public function ramPaginated(Request $request)
    {
        $rams = DB::table('ram')
            ->join('disponibilidad','disponibilidad.id','=','ram.disponibilidad_id')
            ->join('estado','estado.id','=','ram.estado_id')
            ->join('marca','marca.id','=','ram.marca_id')
            ->join('velocidad_ram','velocidad_ram.id','=','ram.velocidad_ram_id')
            ->join('tipo_ram','tipo_ram.id','=','ram.tipo_ram_id')
            ->join('tamano_ram','tamano_ram.id','=','ram.tamano_ram_id')
            ->join('capacidad_ram','capacidad_ram.id','=','ram.capacidad_ram_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Reparacion pendiente')
            ->select('ram.id',
                'ram.ram_nombre',
                'ram.ram_precio',
                'ram.ram_foto',
                'disponibilidad.disponibilidad_nombre',
                'tipo_ram.tipo_ram_nombre',
                'tamano_ram.tamano_ram_nombre',
                'capacidad_ram.capacidad_ram_capacidad',
                'velocidad_ram.velocidad_ram_velocidad',
                'estado.estado_nombre',
                'marca.marca_nombre');

        if($request->disponibilidad != null) $rams = $rams->whereIn('disponibilidad.id',$request->disponibilidad);
        if($request->estado != null) $rams = $rams->whereIn('estado.id',$request->estado);
        if($request->marca != null) $rams = $rams->whereIn('marca.id',$request->marca);

        $rams = $rams->paginate(12);
        return $rams;
    }
}

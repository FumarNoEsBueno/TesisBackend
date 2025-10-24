<?php

namespace App\Http\Controllers;

use App\Models\ram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controller_ram extends Controller
{
    private $intervalo_precio = 10000;

    public function get_ram_by_id(Request $request)
    {
        return Ram::where('id','=',$request->id)->first();
    }

    public function get_every_ram(Request $request)
    {
        return Ram::all()->select('id', 'ram_nombre');
    }

    public function delete_ram(Request $request)
    {
        $ram = Ram::where('id', $request->id)
            ->first()
            ->delete();
        return $ram;
    }

    public function modify_ram(Request $request)
    {
        $ram = Ram::where('id', $request->id)
            ->first()
            ->update([
            'ram_descripcion' => $request->ram_descripcion,
            'ram_nombre' => $request->ram_nombre,
            'ram_foto' => "ram_1.jpg",
            'ram_precio' => $request->ram_precio,
            'ram_descuento' => $request->ram_descuento,
            'ram_destacado' => $request->ram_destacado,
            'disponibilidad_id' => $request->disponibilidad_id,
            'almacen_id' => $request->almacen_id,
            'estado_id' => $request->estado_id,
            'marca_id' => $request->marca_id,
            'tipo_ram_id' => $request->tipo_ram_id,
            'CapacidadRam_id' => $request->CapacidadRam_id,
            'solicitud_recepcion_id' => $request->solicitud_recepcion_id,
            'tamano_ram_id' => $request->tamano_ram_id,
            'velocidad_ram_id' => $request->velocidad_ram_id,
        ]);
        return $ram;
    }

    public function post_ram(Request $request)
    {

        $ram = Ram::create([
            'ram_descripcion' => $request->ram_descripcion,
            'ram_nombre' => $request->ram_nombre,
            'ram_foto' => "ram_1.jpg",
            'ram_precio' => $request->ram_precio,
            'ram_descuento' => $request->ram_descuento,
            'ram_destacado' => $request->ram_destacado,
            'disponibilidad_id' => $request->disponibilidad_id,
            'almacen_id' => $request->almacen_id,
            'estado_id' => $request->estado_id,
            'marca_id' => $request->marca_id,
            'tipo_ram_id' => $request->tipo_ram_id,
            'CapacidadRam_id' => $request->CapacidadRam_id,
            'tamano_ram_id' => $request->tamano_ram_id,
            'velocidad_ram_id' => $request->velocidad_ram_id,
        ]);
        return $ram;
    }

    public function get_all_ram(Request $request)
    {
        $ram= DB::table('ram')
            ->join('disponibilidad','disponibilidad.id','=','ram.disponibilidad_id')
            ->join('estado','estado.id','=','ram.estado_id')
            ->join('marca','marca.id','=','ram.marca_id')
            ->join('velocidad_ram','velocidad_ram.id','=','ram.velocidad_ram_id')
            ->join('tipo_ram','tipo_ram.id','=','ram.tipo_ram_id')
            ->join('tamano_ram','tamano_ram.id','=','ram.tamano_ram_id')
            ->join('CapacidadRam','CapacidadRam.id','=','ram.CapacidadRam_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->select('ram.id',
                'ram.ram_nombre',
                'ram.ram_precio',
                'ram.ram_foto',
                'ram.ram_descuento',
                'ram.ram_destacado',
                'disponibilidad.disponibilidad_nombre',
                'tipo_ram.tipo_ram_nombre',
                'tamano_ram.tamano_ram_nombre',
                'CapacidadRam.CapacidadRam_capacidad',
                'velocidad_ram.velocidad_ram_velocidad',
                'estado.estado_nombre',
                'marca.marca_nombre');

        if($request->estado != null) $ram= $ram->whereIn('estado.id',$request->estado);
        if($request->marca != null) $ram= $ram->whereIn('marca.id',$request->marca);
        if($request->capacidad != null) $ram= $ram->whereIn('CapacidadRam.id',$request->capacidad);
        if($request->tipo != null) $ram= $ram->whereIn('tipo_ram.id',$request->tipo);
        if($request->tamano != null) $ram= $ram->whereIn('tamano_ram.id',$request->tamano);
        if($request->velocidad != null) $ram= $ram->whereIn('velocidad_ram.id',$request->velocidad);
        if($request->precio != null){
            foreach ($request->precio as $precio) {
                $ram= $ram->where('ram_precio','>', ($precio - 1) * $this->intervalo_precio);
                $ram= $ram->where('ram_precio','<', $precio * $this->intervalo_precio);
            }
        }

        $ram= $ram->paginate(12);
        return $ram;
    }
    public function ramPaginated(Request $request)
    {
        $ram= DB::table('ram')
            ->join('disponibilidad','disponibilidad.id','=','ram.disponibilidad_id')
            ->join('estado','estado.id','=','ram.estado_id')
            ->join('marca','marca.id','=','ram.marca_id')
            ->join('velocidad_ram','velocidad_ram.id','=','ram.velocidad_ram_id')
            ->join('tipo_ram','tipo_ram.id','=','ram.tipo_ram_id')
            ->join('tamano_ram','tamano_ram.id','=','ram.tamano_ram_id')
            ->join('CapacidadRam','CapacidadRam.id','=','ram.CapacidadRam_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Reparacion pendiente')
            ->select('ram.id',
                'ram.ram_nombre',
                'ram.ram_precio',
                'ram.ram_foto',
                'ram.ram_descuento',
                'ram.ram_destacado',
                'disponibilidad.disponibilidad_nombre',
                'tipo_ram.tipo_ram_nombre',
                'tamano_ram.tamano_ram_nombre',
                'CapacidadRam.CapacidadRam_capacidad',
                'velocidad_ram.velocidad_ram_velocidad',
                'estado.estado_nombre',
                'marca.marca_nombre');

        if($request->estado != null) $ram= $ram->whereIn('estado.id',$request->estado);
        if($request->marca != null) $ram= $ram->whereIn('marca.id',$request->marca);
        if($request->capacidad != null) $ram= $ram->whereIn('CapacidadRam.id',$request->capacidad);
        if($request->tipo != null) $ram= $ram->whereIn('tipo_ram.id',$request->tipo);
        if($request->tamano != null) $ram= $ram->whereIn('tamano_ram.id',$request->tamano);
        if($request->velocidad != null) $ram= $ram->whereIn('velocidad_ram.id',$request->velocidad);
        if($request->precio != null){
            foreach ($request->precio as $precio) {
                $ram= $ram->where('ram_precio','>', ($precio - 1) * $this->intervalo_precio);
                $ram= $ram->where('ram_precio','<', $precio * $this->intervalo_precio);
            }
        }

        $ram= $ram->paginate(12);
        return $ram;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controller_disco_duro extends Controller
{
    public function get_all_discos_duros(Request $request)
    {
        $discos = DB::table('disco_duro')
            ->join('disponibilidad','disponibilidad.id','=','disco_duro.disponibilidad_id')
            ->join('estado','estado.id','=','disco_duro.estado_id')
            ->join('tamano','tamano.id','=','disco_duro.tamano_id')
            ->join('marca','marca.id','=','disco_duro.marca_id')
            ->join('sistema_archivos','sistema_archivos.id','=','disco_duro.sistema_archivos_id')
            ->join('tipo_entrada','tipo_entrada.id','=','disco_duro.tipo_entrada_id')
            ->leftJoin('descuento','descuento.id','=','disco_duro.descuento_id')
            ->whereNull('compra_id')
            ->select('disco_duro.id',
                'disco_duro.disco_duro_memoria',
                'disco_duro.disco_duro_precio',
                'disco_duro.disco_duro_nombre',
                'disco_duro.disco_duro_foto',
                'disco_duro.disco_duro_horas_encendido',
                'disco_duro.disco_duro_esperanza_vida',
                'disco_duro.disco_duro_crystaldisk',
                'disponibilidad.disponibilidad_nombre',
                'disponibilidad.disponibilidad_descripcion',
                'estado.estado_nombre',
                'tamano.tamano_nombre',
                'tamano.tamano_descripcion',
                'marca.marca_nombre',
                'descuento.descuento_porcentaje',
                'sistema_archivos.sistema_archivos_nombre');

        if($request->disponibilidad != null) $discos = $discos->whereIn('disponibilidad.id',$request->disponibilidad);
        if($request->estado != null) $discos = $discos->whereIn('estado.id',$request->estado);
        if($request->tamano != null) $discos = $discos->whereIn('tamano.id',$request->tamano);
        if($request->marca != null) $discos = $discos->whereIn('marca.id',$request->marca);
        if($request->sistema_archivos != null) $discos = $discos->whereIn('sistema_archivos.id',$request->sistema_archivos);

        $discos = $discos->paginate(12);
        return $discos;
    }
    public function discosDurosPaginated(Request $request)
    {
        $discos = DB::table('disco_duro')
            ->join('disponibilidad','disponibilidad.id','=','disco_duro.disponibilidad_id')
            ->join('estado','estado.id','=','disco_duro.estado_id')
            ->join('tamano','tamano.id','=','disco_duro.tamano_id')
            ->join('marca','marca.id','=','disco_duro.marca_id')
            ->join('sistema_archivos','sistema_archivos.id','=','disco_duro.sistema_archivos_id')
            ->join('tipo_entrada','tipo_entrada.id','=','disco_duro.tipo_entrada_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
            ->whereNull('compra_id')
            ->select('disco_duro.id',
                'disco_duro.disco_duro_memoria',
                'disco_duro.disco_duro_precio',
                'disco_duro.disco_duro_nombre',
                'disco_duro.disco_duro_foto',
                'disco_duro.disco_duro_horas_encendido',
                'disco_duro.disco_duro_esperanza_vida',
                'disco_duro.disco_duro_crystaldisk',
                'disponibilidad.disponibilidad_nombre',
                'disponibilidad.disponibilidad_descripcion',
                'estado.estado_nombre',
                'tamano.tamano_nombre',
                'tamano.tamano_descripcion',
                'marca.marca_nombre',
                'sistema_archivos.sistema_archivos_nombre');

        if($request->disponibilidad != null) $discos = $discos->whereIn('disponibilidad.id',$request->disponibilidad);
        if($request->estado != null) $discos = $discos->whereIn('estado.id',$request->estado);
        if($request->tamano != null) $discos = $discos->whereIn('tamano.id',$request->tamano);
        if($request->marca != null) $discos = $discos->whereIn('marca.id',$request->marca);
        if($request->sistema_archivos != null) $discos = $discos->whereIn('sistema_archivos.id',$request->sistema_archivos);

        $discos = $discos->paginate(12);
        return $discos;
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\disco_duro;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class controller_disco_duro extends Controller
{
    public function index(Request $request)
    {
        $coso = DB::table('disco_duro')
            ->join('disponibilidad','disponibilidad.id','=','disco_duro.disponibilidad_id')
            ->join('estado','estado.id','=','disco_duro.estado_id')
            ->join('tamano','tamano.id','=','disco_duro.tamano_id')
            ->join('marca','marca.id','=','disco_duro.marca_id')
            ->join('sistema_archivos','sistema_archivos.id','=','disco_duro.sistema_archivos_id')
            ->where('disponibilidad.disponibilidad_nombre', '!=', 'Vendido')
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

        if($request->disponibilidad != null) $coso = $coso->whereIn('disponibilidad.id',$request->disponibilidad);
        if($request->estado != null) $coso = $coso->whereIn('estado.id',$request->estado);
        if($request->tamano != null) $coso = $coso->whereIn('tamano.id',$request->tamano);
        if($request->marca != null) $coso = $coso->whereIn('marca.id',$request->marca);
        if($request->sistema_archivos != null) $coso = $coso->whereIn('sistema_archivos.id',$request->sistema_archivos);

        $coso = $coso->paginate(12);
        return $coso;
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\RecepcionEstado;
use App\Models\solicitud_recepcion;
use Illuminate\Http\Request;

class controller_recepcion extends Controller
{
    public function get_lotes_recepcionados(Request $request)
    {
        $recepcion_estado = RecepcionEstado::where('recepcion_estado_nombre','=','Recepcionado')
            ->first();

        $recepcion = solicitud_recepcion
            ::where('recepcion_estado_id', '=', $recepcion_estado->id)
            ->latest()
            ->get();

        return $recepcion;
    }

    public function confirmar_recepcion(Request $request)
    {
        $recepcion_estado = RecepcionEstado::where('recepcion_estado_nombre','=','Recepcionado')
            ->first();

        $recepcion = solicitud_recepcion::
            where('id', $request->id)
            ->first()
            ->update(['recepcion_estado_id' => $recepcion_estado->id]);

        return $recepcion;
    }

    public function cancelar_recepcion(Request $request)
    {
        $recepcion_estado = RecepcionEstado::where('recepcion_estado_nombre','=','Recepcion cancelada')
            ->first();

        $recepcion = solicitud_recepcion::
            where('id', $request->id)
            ->first()
            ->update(['recepcion_estado_id' => $recepcion_estado->id]);

        return $recepcion;
    }

    public function get_all_recepcion_paginated(Request $request)
    {
        $recepcion = solicitud_recepcion::
            with('disco')
            ->with('ram')
            ->with('periferico')
            ->with('cable')
            ->with('users')
            ->with('recepcion_estado')
            ->where('solicitud_recepcion_codigo','LIKE','%'.$request->codigo.'%')        
            ->where('recepcion_estado_id','=',$request->estado)
            ->paginate(5);

        return $recepcion;
    }

    public function get_recepcion_paginated_by_user_id(Request $request)
    {
        $recepcion = solicitud_recepcion::where('user_id', $request->user()->id)
            ->with('recepcion_estado')
            ->latest()
            ->paginate(5);

        return $recepcion;
    }

    public function create_recepcion(Request $request)
    {
        $recepcion = new solicitud_recepcion();
        $randomCode = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'), 0, 6);

        $recepcion->user_id = $request->user()->id;
        $recepcion->solicitud_recepcion_volumen_aproximado = $request->volumen;
        $recepcion->recepcion_estado_id = 1;
        $recepcion->solicitud_recepcion_peso_aproximado = $request->peso;
        $recepcion->solicitud_recepcion_codigo = $randomCode;
        $recepcion->solicitud_recepcion_descripcion = $request->descripcion;
        $recepcion->metodo_despacho_id = $request->metodoId;

        $recepcion->save();
    }
}

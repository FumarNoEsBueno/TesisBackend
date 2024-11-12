<?php

namespace App\Http\Controllers;

use App\Models\recepcion_estado;
use App\Models\solicitud_recepcion;
use Illuminate\Http\Request;

class controller_recepcion extends Controller
{
    public function confirmar_recepcion(Request $request)
    {
        $recepcion_estado = recepcion_estado::where('recepcion_estado_nombre','=','Recepcionado')
            ->first();

        $recepcion = solicitud_recepcion::
            where('id', $request->id)
            ->first()
            ->update(['recepcion_estado_id' => $recepcion_estado->id]);

        return $recepcion;
    }

    public function cancelar_recepcion(Request $request)
    {
        $recepcion_estado = recepcion_estado::where('recepcion_estado_nombre','=','Recepcion cancelada')
            ->first();

        $recepcion = solicitud_recepcion::
            where('id', $request->id)
            ->first()
            ->update(['recepcion_estado_id' => $recepcion_estado->id]);

        return $recepcion;
    }

    public function get_all_recepcion_paginated(Request $request)
    {
        $recepcion = solicitud_recepcion
            ::with('recepcion_estado')
            ->with('user')
            ->latest()
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

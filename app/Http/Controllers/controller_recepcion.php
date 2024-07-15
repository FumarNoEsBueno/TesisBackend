<?php

namespace App\Http\Controllers;

use App\Models\solicitud_recepcion;
use Illuminate\Http\Request;

class controller_recepcion extends Controller
{
    public function get_recepcion_paginated_by_user_id(Request $request)
    {
        $recepcion = solicitud_recepcion::where('user_id', $request->user()->id)
            ->latest()
            ->paginate(12);

        return $recepcion;
    }

    public function create_recepcion(Request $request)
    {
        $recepcion = new solicitud_recepcion();

        $recepcion->user_id = $request->user()->id;
        $recepcion->solicitud_recepcion_volumen_aproximado = $request->volumen;
        $recepcion->solicitud_recepcion_peso_aproximado = $request->peso;
        $recepcion->solicitud_recepcion_descripcion = $request->descripcion;
        $recepcion->metodo_despacho_id = $request->metodoId;

        $recepcion->save();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index() {
        $productos = DB::table('producto')
            ->join('estado', 'producto.estado_id', '=', 'estado.id')
            ->join('almacen', 'producto.almacen_id', '=', 'almacen.id')
            ->select(
                'producto.id',
                'producto.tipo',
                'producto.descripcion',
                'producto.peso',
                'producto.fecha',
                'producto.hora',
                'estado.estado_nombre',
                'almacen.almacen_nombre'
            )
            ->get();

        return response()->json(['data' => $productos]);
    }

    // Otros métodos store, show, update, delete si se necesitan

}

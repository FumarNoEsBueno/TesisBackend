<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index() {
    $productos = DB::table('producto')->select('id', 'tipo', 'descripcion')->get()->map(function($p){
        return [
            'id' => $p->id,
            'nombre' => $p->tipo . ' ' . substr($p->descripcion, 0, 20) // o la lógica para nombre
        ];
    });
    return response()->json(['data'=>$productos]);
}


    // Otros métodos store, show, update, delete si se necesitan
}

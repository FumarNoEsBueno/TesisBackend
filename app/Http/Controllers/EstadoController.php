<?php
// app/Http/Controllers/EstadoController.php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function index()
    {
        $estado = Estado::all();
        return response()->json($estado); // Devuelve directamente la colección
    }
}
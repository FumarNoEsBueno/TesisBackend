<?php
// app/Http/Controllers/EstadoController.php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function index()
    {
        $estados = Estado::all();
        return response()->json($estados); // Devuelve directamente la colección
    }
}
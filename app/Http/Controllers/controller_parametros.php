<?php

namespace App\Http\Controllers;

use App\Models\disponibilidad;
use App\Models\estado;
use App\Models\marca;
use App\Models\sistema_archivos;
use App\Models\tamano;
use Illuminate\Http\Request;

class controller_parametros extends Controller
{
    public function marca()
    {
        return marca::all();
    }

    public function disponibilidad()
    {
        return disponibilidad::all();
    }
    public function sistemaArchivos()
    {
        return sistema_archivos::all();
    }
    public function tamano()
    {
        return tamano::all();
    }
    public function estado()
    {
        return estado::all();
    }
}

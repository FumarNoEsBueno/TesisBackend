<?php

namespace App\Http\Controllers;

use App\Models\capacidad_ram;
use App\Models\disponibilidad;
use App\Models\estado;
use App\Models\marca;
use App\Models\model_estado_compra;
use App\Models\model_metodo_despacho;
use App\Models\recepcion_estado;
use App\Models\sistema_archivos;
use App\Models\tamano;
use App\Models\tamano_ram;
use App\Models\tipo_entrada;
use App\Models\tipo_periferico;
use App\Models\tipo_ram;
use App\Models\velocidad_ram;
use Illuminate\Http\Request;

class controller_parametros extends Controller
{
    public function tipo_entrada()
    {
        return tipo_entrada::all();
    }

    public function capacidad_ram()
    {
        return capacidad_ram::all();
    }

    public function despacho()
    {
        return model_metodo_despacho::all();
    }

    public function tipo_periferico()
    {
        return tipo_periferico::all();
    }

    public function tipo_ram()
    {
        return tipo_ram::all();
    }

    public function velocidad_ram()
    {
        return velocidad_ram::all();
    }

    public function tamano_Ram()
    {
        return tamano_ram::all();
    }

    public function marca()
    {
        return marca::all();
    }

    public function estado_compra()
    {
        return model_estado_compra::all();
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

    public function estado_recepcion()
    {
        return recepcion_estado::all();
    }

    public function estado()
    {
        return estado::all();
    }
}

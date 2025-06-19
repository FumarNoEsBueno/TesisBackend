<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use App\Models\CapacidadRam;
use App\Models\Disponibilidad;
use App\Models\Estado;
use App\Models\Marca;
use App\Models\EstadoCompra;
use App\Models\MetodoDespacho;
use App\Models\RecepcionEstado;
use App\Models\SistemaArchivos;
use App\Models\Tamano;
use App\Models\TamanoRam;
use App\Models\TipoEntrada;
use App\Models\TipoPeriferico;
use App\Models\TipoRam;
use App\Models\VelocidadRam;
use Illuminate\Http\Request;

class controller_parametros extends Controller
{
    public function Almacen()
    {
        return Almacen::all();
    }

    public function TipoEntrada()
    {
        return TipoEntrada::all();
    }

    public function CapacidadRam()
    {
        return CapacidadRam::all();
    }

    public function MetodoDespacho()
    {
        return MetodoDespacho::all();
    }

    public function TipoPeriferico()
    {
        return TipoPeriferico::all();
    }

    public function TipoRam()
    {
        return TipoRam::all();
    }

    public function VelocidadRam()
    {
        return VelocidadRam::all();
    }

    public function TamanoRam()
    {
        return TamanoRam::all();
    }

    public function Marca()
    {
        return Marca::all();
    }

    public function Disponibilidad()
    {
        return Disponibilidad::all();
    }
    
    public function SistemaArchivos()
    {
        return SistemaArchivos::all();
    }
    public function Tamano()
    {
        return Tamano::all();
    }
    
    public function EstadoCompra()
    {
        return Estado::with('compra')->get();
    }

    public function EstadoVenta()
    {
        return Estado::with('venta')->get();
    }

    public function EstadoRecepcion()
    {
        return RecepcionEstado::all(); 
    }

    public function EstadoProducto(Request $request)
    {
        $producto = $request->input('producto');
        return Estado::with($producto)->get();
    }
}

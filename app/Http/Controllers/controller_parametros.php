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
    public function almacen()
    {
        return Almacen::all();
    }

    public function tipo_entrada()
    {
        return TipoEntrada::all();
    }

    public function capacidad_ram()
    {
        return CapacidadRam::all();
    }

    public function metodo_despacho()
    {
        return MetodoDespacho::all();
    }

    public function tipo_periferico()
    {
        return TipoPeriferico::all();
    }

    public function tipo_ram()
    {
        return TipoRam::all();
    }

    public function velocidad_ram()
    {
        return VelocidadRam::all();
    }

    public function tamano_ram()
    {
        return TamanoRam::all();
    }

    public function marca()
    {
        return Marca::all();
    }

    public function disponibilidad()
    {
        return Disponibilidad::all();
    }

    public function sistema_archivos()
    {
        return SistemaArchivos::all();
    }

    public function tamano()
    {
        return Tamano::all();
    }

    public function estado_compra()
    {
        return Estado::with('compras')->get();//este si con compras. hay 2 funciones aqui
    }

    public function estado_venta()
    {
        return Estado::with('venta')->get();
    }

    public function estado_recepcion()
    {
        return RecepcionEstado::all(); 
    }

    public function estado_producto(Request $request)
    {
        $producto = $request->input('producto');
        return Estado::with($producto)->get();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\estado;
use App\Models\marca;
use Illuminate\Http\Request;

class controller_parametros extends Controller
{
    public function marca()
    {
        return marca::all();
    }

    public function estado()
    {
        return estado::all();
    }
}

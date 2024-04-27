<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controller_compra extends Controller
{
    public function comprar(Request $request)
    {
        return http_response_code(200);
    }
}

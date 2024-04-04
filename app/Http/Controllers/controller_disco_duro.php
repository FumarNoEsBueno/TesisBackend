<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\disco_duro;

class controller_disco_duro extends Controller
{
    public function index()
    {
        return disco_duro::all();
    }

}

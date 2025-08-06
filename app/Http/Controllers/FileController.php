<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    public function serveCableImage($filename)
    {
        $path = storage_path('app/public/cables/' . $filename);
        
        if (!file_exists($path)) {
            abort(404);
        }
        
        return Response::file($path);
    }
}
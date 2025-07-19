<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/', function () {
    print("Wena los k");
});

Route::get('/test-storage', function() {
    // Guardar un archivo de prueba
    Storage::disk('public')->put('test.txt', 'Contenido de prueba');
    
    // Generar URL
    $url = Storage::disk('public')->url('test.txt');
    
    return "Archivo creado: <a href='$url'>$url</a>";
});

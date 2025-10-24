<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Auth::routes([
    'reset'  => false,
    'verify' => false,
]);

Route::get('/', function () {
    return 'Wena los k';
});

Route::get('/test-storage', function() {
    Storage::disk('public')->put('test.txt', 'Contenido de prueba');
    $url = Storage::disk('public')->url('test.txt');
    return "Archivo creado: <a href='$url'>$url</a>";
});

Route::get('storage/cables/{filename}', [FileController::class, 'serveCableImage'])
     ->where('filename', '.*');

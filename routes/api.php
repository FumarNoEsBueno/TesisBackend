<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller_disco_duro;
use App\Http\Controllers\controller_parametros;

Route::get('/test',[controller_disco_duro::class, 'index']);
Route::get('/parametros/estado',[controller_parametros::class, 'estado']);
Route::get('/parametros/marca',[controller_parametros::class, 'marca']);
Route::get('/parametros/disponibilidad',[controller_parametros::class, 'disponibilidad']);
Route::get('/parametros/sistema-archivos',[controller_parametros::class, 'sistemaArchivos']);
Route::get('/parametros/tamano',[controller_parametros::class, 'tamano']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

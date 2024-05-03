<?php

use App\Http\Controllers\controller_compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller_disco_duro;
use App\Http\Controllers\controller_parametros;
use App\Http\Controllers\controller_periferico;
use App\Http\Controllers\controller_ram;

Route::post('/comprar',[controller_compra::class, 'comprar']);
Route::get('/compras',[controller_compra::class, 'compras']);
Route::get('/discosDuros',[controller_disco_duro::class, 'discosDurosPaginated']);
Route::get('/perifericos',[controller_periferico::class, 'perifericosPaginated']);
Route::get('/rams',[controller_ram::class, 'ramPaginated']);
Route::get('/parametros/estado',[controller_parametros::class, 'estado']);
Route::get('/parametros/marca',[controller_parametros::class, 'marca']);
Route::get('/parametros/disponibilidad',[controller_parametros::class, 'disponibilidad']);
Route::get('/parametros/sistema-archivos',[controller_parametros::class, 'sistemaArchivos']);
Route::get('/parametros/tamano',[controller_parametros::class, 'tamano']);

Route::get('/images/{nombreImagen}', function ($nombreImagen) {
    return response()->file(public_path('images/' . $nombreImagen));
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

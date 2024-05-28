<?php

use App\Http\Controllers\controller_admin;
use App\Http\Controllers\controller_compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controller_disco_duro;
use App\Http\Controllers\controller_parametros;
use App\Http\Controllers\controller_periferico;
use App\Http\Controllers\controller_profile;
use App\Http\Controllers\controller_ram;

//Admin routes
Route::post('/admin_login',[controller_admin::class, 'admin_login']);
Route::middleware('auth:api')->post('/check_admin_login',[controller_admin::class, 'check_admin_login']);
Route::middleware('auth:api')->post('/get_all_compras',[controller_compra::class, 'get_all_compras']);
Route::get('/get_all_discos_duros',[controller_disco_duro::class, 'get_all_discos_duros']);
Route::get('/get_descuentos',[controller_admin::class, 'get_descuentos']);
Route::middleware('auth:api')->post('/set_producto',[controller_admin::class, 'set_producto']);

//User routes
Route::middleware('auth:api')->post('/comprar',[controller_compra::class, 'comprar']);
Route::middleware('auth:api')->post('/get_compras_by_user_id',[controller_compra::class, 'get_compras_by_user_id']);
Route::middleware('auth:api')->post('/check_login',[controller_profile::class, 'checkLogin']);
Route::middleware('auth:api')->post('/revoke_token',[controller_profile::class, 'revoke_token']);
Route::middleware('auth:api')->get('/direcciones',[controller_profile::class, 'get_direcciones_by_user']);
Route::post('/login',[controller_profile::class, 'login']);
Route::post('/register',[controller_profile::class, 'register']);
Route::get('/compras',[controller_compra::class, 'compras']);
Route::get('/discosDuros',[controller_disco_duro::class, 'discosDurosPaginated']);
Route::get('/perifericos',[controller_periferico::class, 'perifericosPaginated']);
Route::get('/rams',[controller_ram::class, 'ramPaginated']);
Route::get('/parametros/estado',[controller_parametros::class, 'estado']);
Route::get('/parametros/estado_compra',[controller_parametros::class, 'estado_compra']);
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

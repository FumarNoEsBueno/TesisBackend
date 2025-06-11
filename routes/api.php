<?php

use App\Http\Controllers\controller_admin;
use App\Http\Controllers\controller_cable;
use App\Http\Controllers\controller_compra;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\controller_disco_duro;
use App\Http\Controllers\controller_parametros;
use App\Http\Controllers\controller_periferico;
use App\Http\Controllers\controller_profile;
use App\Http\Controllers\controller_ram;
use App\Http\Controllers\controller_recepcion;
use App\Http\Controllers\controller_transporte;
use App\Http\Controllers\controller_almacen;
use App\Http\Controllers\controller_residuo;
use App\Http\Controllers\controller_cargador;
use App\Http\Controllers\controller_tarea;
use App\Http\Controllers\ReparacionController;
use App\Http\Controllers\HerramientaController;



//Admin routes
Route::post('/admin_login',[controller_admin::class, 'admin_login']);
Route::get('/correo',[controller_admin::class, 'enviarCorreo']);
Route::middleware('auth:api')->post('/check_admin_login',[controller_admin::class, 'check_admin_login']);
Route::middleware('auth:api')->post('/get_all_compras',[controller_compra::class, 'get_all_compras']);
Route::middleware('auth:api')->post('/get_all_recepciones',[controller_recepcion::class, 'get_all_recepcion_paginated']);
Route::get('/get_lotes_recepcionados',[controller_recepcion::class, 'get_lotes_recepcionados']);
Route::get('/get_all_ram',[controller_ram::class, 'get_all_ram']);
Route::get('/get_every_ram',[controller_ram::class, 'get_every_ram']);
Route::get('/get_ram_by_id',[controller_ram::class, 'get_ram_by_id']);
Route::get('/get_all_periferico',[controller_periferico::class, 'get_all_periferico']);
Route::get('/get_every_periferico',[controller_periferico::class, 'get_every_periferico']);
Route::get('/get_periferico_by_id',[controller_periferico::class, 'get_periferico_by_id']);
Route::get('/get_all_cable',[controller_cable::class, 'get_all_cable']);
Route::get('/get_every_cable',[controller_cable::class, 'get_every_cable']);
Route::get('/get_cable_by_id',[controller_cable::class, 'get_cable_by_id']);
Route::get('/get_all_discos_duros',[controller_disco_duro::class, 'get_all_discos_duros']);
Route::get('/get_every_disco_duro',[controller_disco_duro::class, 'get_every_disco_duro']);
Route::get('/get_disco_duro_by_id',[controller_disco_duro::class, 'get_disco_duro_by_id']);
Route::get('/get_descuentos',[controller_admin::class, 'get_descuentos']);
Route::get('/get_productos_comprados_estadisticas',[controller_compra::class, 'get_productos_comprados_estadisticas']);
Route::middleware('auth:api')->post('/set_producto',[controller_admin::class, 'set_producto']);
Route::middleware('auth:api')->post('/update_estado_compra',[controller_admin::class, 'update_estado_compra']);
Route::middleware('auth:api')->post('/cancelar_recepcion',[controller_recepcion::class, 'cancelar_recepcion']);
Route::middleware('auth:api')->post('/confirmar_recepcion',[controller_recepcion::class, 'confirmar_recepcion']);
Route::middleware('auth:api')->post('/post_disco_duro',[controller_disco_duro::class, 'post_disco_duro']);
Route::middleware('auth:api')->post('/modify_ram',[controller_ram::class, 'modify_ram']);
Route::middleware('auth:api')->post('/delete_ram',[controller_ram::class, 'delete_ram']);
Route::middleware('auth:api')->post('/modify_periferico',[controller_periferico::class, 'modify_periferico']);
Route::middleware('auth:api')->post('/delete_periferico',[controller_periferico::class, 'delete_periferico']);
Route::middleware('auth:api')->post('/modify_cable',[controller_cable::class, 'modify_cable']);
Route::middleware('auth:api')->post('/delete_cable',[controller_cable::class, 'delete_cable']);
Route::middleware('auth:api')->post('/modify_disco_duro',[controller_disco_duro::class, 'modify_disco_duro']);
Route::middleware('auth:api')->post('/delete_disco_duro',[controller_disco_duro::class, 'delete_disco_duro']);
Route::middleware('auth:api')->post('/post_ram',[controller_ram::class, 'post_ram']);
Route::middleware('auth:api')->post('/post_periferico',[controller_periferico::class, 'post_periferico']);
Route::middleware('auth:api')->post('/post_cable',[controller_cable::class, 'post_cable']);
Route::middleware('auth:api')->get('/get_ventas_para_estadisticas',[controller_compra::class, 'get_ventas_para_estadisticas']);

//User routes
Route::middleware('auth:api')->post('/comprar',[controller_compra::class, 'comprar']);
Route::middleware('auth:api')->post('/get_compras_by_user_id',[controller_compra::class, 'get_compras_by_user_id']);
Route::middleware('auth:api')->post('/create_user',[controller_admin::class, 'create_user']);
Route::middleware('auth:api')->post('/get_recepcion_paginated_by_user_id',[controller_recepcion::class, 'get_recepcion_paginated_by_user_id']);
Route::middleware('auth:api')->post('/check_login',[controller_profile::class, 'checkLogin']);
Route::middleware('auth:api')->post('/revoke_token',[controller_profile::class, 'revoke_token']);
Route::middleware('auth:api')->get('/direcciones',[controller_profile::class, 'get_direcciones_by_user']);
Route::middleware('auth:api')->post('/create_direccion',[controller_profile::class, 'create_direccion']);
Route::middleware('auth:api')->post('/delete_direccion',[controller_profile::class, 'delete_direccion']);
Route::middleware('auth:api')->post('/create_recepcion',[controller_recepcion::class, 'create_recepcion']);
Route::middleware('auth:api')->post('/update_password',[controller_profile::class, 'update_password']);

Route::post('/login',[controller_profile::class, 'login']);
Route::post('/register',[controller_profile::class, 'register']);
Route::get('/discosDuros',[controller_disco_duro::class, 'discosDurosPaginated']);
Route::get('/perifericos',[controller_periferico::class, 'perifericosPaginated']);
Route::get('/get_all_perifericos',[controller_periferico::class, 'get_all_perifericos']);
Route::get('/rams',[controller_ram::class, 'ramPaginated']);
Route::get('/get_all_ram',[controller_ram::class, 'get_all_ram']);
Route::get('/cables',[controller_cable::class, 'getCablesPaginated']);
Route::get('/get_all_cable',[controller_cable::class, 'get_all_cable']);
Route::get('/get_cable_recomendado',[controller_cable::class, 'get_cable_recomendado']);
Route::get('/get_productos_nuevos',[controller_compra::class, 'get_productos_nuevos']);
Route::get('/get_productos_destacados',[controller_compra::class, 'get_productos_destacados']);

Route::get('/parametros/estado',[controller_parametros::class, 'estado']);
Route::get('/parametros/estado_compra',[controller_parametros::class, 'estado_compra']);
Route::get('/parametros/estado_venta',[controller_parametros::class, 'estado_venta']);
Route::get('/parametros/estado_recepcion',[controller_parametros::class, 'estado_recepcion']);
Route::get('/parametros/almacen',[controller_parametros::class, 'almacen']);
Route::get('/parametros/marca',[controller_parametros::class, 'marca']);
Route::get('/parametros/disponibilidad',[controller_parametros::class, 'disponibilidad']);
Route::get('/parametros/sistema-archivos',[controller_parametros::class, 'sistemaArchivos']);
Route::get('/parametros/tamano',[controller_parametros::class, 'tamano']);
Route::get('/parametros/tamano_ram',[controller_parametros::class, 'tamano_ram']);
Route::get('/parametros/velocidad_ram',[controller_parametros::class, 'velocidad_ram']);
Route::get('/parametros/tipo_ram',[controller_parametros::class, 'tipo_ram']);
Route::get('/parametros/tipo_periferico',[controller_parametros::class, 'tipo_periferico']);
Route::get('parametros/tipo_entrada',[controller_parametros::class, 'tipo_entrada']);
Route::get('/parametros/despacho',[controller_parametros::class, 'despacho']);
Route::get('/parametros/capacidad_ram',[controller_parametros::class, 'capacidad_ram']);

Route::get('/get_ciudades_por_provincia',[controller_profile::class, 'get_ciudades_por_provincia']);
Route::get('/get_provincias_por_region',[controller_profile::class, 'get_provincias_por_region']);
Route::get('/get_regiones',[controller_profile::class, 'get_regiones']);


Route::get('/images/{nombreImagen}', function ($nombreImagen) {
    return response()->file(public_path('images/' . $nombreImagen));
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//-----------------------------------------
//-----------------------------------------
//Rutas de la tesis de Diego
//-----------------------------------------
//-----------------------------------------

//-----------------------------------------
//Transporte
Route::put('/transportes/{id}', [controller_transporte::class, 'update']);
Route::middleware('auth:api')->post('/solicitar_transporte',[controller_transporte::class, 'solicitarTransporte']);
Route::get('/get_all_transportes',[controller_transporte::class, 'getAllTransportes']);

//-----------------------------------------
//Registrar residuo

// Lista de residuos
Route::get('/residuos', [controller_residuo::class, 'get_all_residuos']);
Route::get('/residuos/{id}', [controller_residuo::class, 'get_residuo_by_id']);
Route::post('/residuos', [controller_residuo::class, 'store']);
Route::put('/residuos/{id}', [controller_residuo::class, 'update_residuo']);
Route::delete('/residuos/{id}', [controller_residuo::class, 'delete_residuo']);
// Registrar producto cargador
Route::middleware('auth:api')->post('/registrar_cargador', [controller_cargador::class, 'store']);
Route::get('/get_cargador_by_id', [controller_cargador::class, 'get_cargador_by_id']);
Route::middleware('auth:api')->get('/get_all_cargadores', [controller_cargador::class, 'get_all_cargadores']);
Route::middleware('auth:api')->post('/update_cargador', [controller_cargador::class, 'update_cargador']);
Route::middleware('auth:api')->post('/delete_cargador', [controller_cargador::class, 'delete_cargador']);

Route::get('/tarea/urgente', [controller_tarea::class, 'urgente']);

Route::middleware('auth:api')->post('/tarea/tasar', [controller_tarea::class, 'tasar_producto']);
Route::get('tarea/sin_precio', [controller_tarea::class, 'listar_sin_precio']);
Route::get('/get_all_reparacion', [ReparacionController::class, 'index']);
Route::get('/reparacion', [ReparacionController::class, 'index']);


Route::apiResource('herramienta', HerramientaController::class);
Route::delete('reparacion/{id}', [ReparacionController::class, 'destroy']);

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import de controladores
use App\Http\Controllers\controller_admin;
use App\Http\Controllers\controller_profile;
use App\Http\Controllers\controller_compra;
use App\Http\Controllers\controller_recepcion;
use App\Http\Controllers\controller_ram;
use App\Http\Controllers\controller_periferico;
use App\Http\Controllers\CableController;
use App\Http\Controllers\controller_disco_duro;
use App\Http\Controllers\controller_parametros;
use App\Http\Controllers\controller_almacen;
use App\Http\Controllers\controller_transporte;
use App\Http\Controllers\controller_residuo;
use App\Http\Controllers\controller_cargador;
use App\Http\Controllers\controller_tarea;
use App\Http\Controllers\ReparacionController;
use App\Http\Controllers\HerramientaController;
use App\Http\Controllers\UpgradeoController;

use App\Http\Controllers\CableFotoController;
use App\Http\Controllers\ProductoFotoController;
use App\Http\Controllers\ProductoController;


    
// Rutas API públicas para pruebas
Route::get('test', function() {
    return response()->json([
        'status' => 'success',
        'message' => '¡La ruta de prueba funciona!',
        'data' => [
            'server_time' => now()->toDateTimeString(),
            'laravel_version' => app()->version()
        ]
    ]);
});

Route::get('cable/{id}/fotos', [CableFotoController::class, 'index']);



// -----------------------------------------
// RUTAS DE AUTENTICACIÓN / PERFIL
// -----------------------------------------

// Login / register (sin middleware)
Route::post('/login', [controller_profile::class, 'login']);
Route::post('/register', [controller_profile::class, 'register']);

// Check login, logout, perfil, direcciones, etc. (requiere token)
Route::middleware('auth:api')->group(function() {
    Route::post('/check_login', [controller_profile::class, 'checkLogin']);
    Route::post('/revoke_token', [controller_profile::class, 'revoke_token']);
    Route::post('/update_password', [controller_profile::class, 'update_password']);

    // Direcciones de usuario
    Route::get('/direcciones', [controller_profile::class, 'get_direcciones_by_user']);
    Route::post('/create_direccion', [controller_profile::class, 'create_direccion']);
    Route::post('/delete_direccion', [controller_profile::class, 'delete_direccion']);

    // Provincias / ciudades / regiones (puede ser sin auth si es público)
    Route::get('/get_ciudades_por_provincia', [controller_profile::class, 'get_ciudades_por_provincia']);
    Route::get('/get_provincias_por_region', [controller_profile::class, 'get_provincias_por_region']);
    Route::get('/get_regiones', [controller_profile::class, 'get_regiones']);
});

// Ruta para obtener info de usuario autenticado
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// -----------------------------------------
// RUTAS ADMIN (controller_admin)
// -----------------------------------------

// Login admin (si separado) y rutas de admin
Route::post('/admin_login', [controller_admin::class, 'admin_login']);
Route::get('/correo', [controller_admin::class, 'enviarCorreo']);

Route::middleware('auth:api')->group(function() {
    Route::post('/check_admin_login', [controller_admin::class, 'check_admin_login']);
    Route::post('/set_producto', [controller_admin::class, 'set_producto']);
    Route::post('/update_estado_compra', [controller_admin::class, 'update_estado_compra']);
    // Crear usuario
    Route::post('/create_user', [controller_admin::class, 'create_user']);
});

// -----------------------------------------
// RUTAS DE COMPRAS (controller_compra)
// -----------------------------------------

Route::middleware('auth:api')->group(function() {
    Route::post('/comprar', [controller_compra::class, 'comprar']);
    Route::post('/get_compras_by_user_id', [controller_compra::class, 'get_compras_by_user_id']);
    Route::post('/get_all_compras', [controller_compra::class, 'get_all_compras']);
    Route::post('/get_all_recepciones', [controller_recepcion::class, 'get_all_recepcion_paginated']);
    Route::get('/get_ventas_para_estadisticas', [controller_compra::class, 'get_ventas_para_estadisticas']);
});
Route::get('/get_productos_nuevos', [controller_compra::class, 'get_productos_nuevos']);
Route::get('/get_productos_destacados', [controller_compra::class, 'get_productos_destacados']);
Route::get('/get_productos_comprados_estadisticas', [controller_compra::class, 'get_productos_comprados_estadisticas']);

// -----------------------------------------
// RUTAS RECEPCIÓN (controller_recepcion)
// -----------------------------------------

Route::middleware('auth:api')->group(function() {
    Route::post('/create_recepcion', [controller_recepcion::class, 'create_recepcion']);
    Route::post('/cancelar_recepcion', [controller_recepcion::class, 'cancelar_recepcion']);
    Route::post('/confirmar_recepcion', [controller_recepcion::class, 'confirmar_recepcion']);
    Route::post('/get_recepcion_paginated_by_user_id', [controller_recepcion::class, 'get_recepcion_paginated_by_user_id']);
});
// Público o sin auth para algunos:
Route::get('/get_lotes_recepcionados', [controller_recepcion::class, 'get_lotes_recepcionados']);

// -----------------------------------------
// RUTAS RAM (controller_ram)
// -----------------------------------------

Route::get('/get_all_ram', [controller_ram::class, 'get_all_ram']);
Route::get('/get_every_ram', [controller_ram::class, 'get_every_ram']);
Route::get('/get_ram_by_id', [controller_ram::class, 'get_ram_by_id']);
Route::get('/ram', [controller_ram::class, 'ramPaginated']);

Route::middleware('auth:api')->group(function() {
    Route::post('/post_ram', [controller_ram::class, 'post_ram']);
    Route::post('/modify_ram', [controller_ram::class, 'modify_ram']);
    Route::post('/delete_ram', [controller_ram::class, 'delete_ram']);
});

// -----------------------------------------
// RUTAS PERIFÉRICO (controller_periferico)
// -----------------------------------------

Route::get('/get_all_periferico', [controller_Periferico::class, 'get_all_periferico']);
Route::get('/get_every_periferico', [controller_Periferico::class, 'get_every_periferico']);
Route::get('/get_periferico_by_id', [controller_Periferico::class, 'get_periferico_by_id']);
Route::get('/perifericos', [controller_Periferico::class, 'perifericosPaginated']);

Route::middleware('auth:api')->group(function() {
    Route::post('/post_periferico', [controller_Periferico::class, 'post_periferico']);
    Route::post('/modify_periferico', [controller_Periferico::class, 'modify_periferico']);
    Route::post('/delete_periferico', [controller_Periferico::class, 'delete_periferico']);
});

// -----------------------------------------
// RUTAS CABLE (CableController)
// -----------------------------------------
Route::get('/list_cable', [CableController::class, 'get_all_cable']);
Route::get('/get_all_cable', [CableController::class, 'get_all_cable']);
Route::get('/get_every_cable', [CableController::class, 'get_every_cable']);
Route::get('/get_cable_by_id', [CableController::class, 'get_cable_by_id']);
Route::get('/list_cable_paginated', [CableController::class, 'getCablesPaginated']);
Route::get('/get_cable_recomendado', [CableController::class, 'get_cable_recomendado']);

Route::get('/cable/{id}', [CableController::class, 'show']);

Route::middleware('auth:api')->group(function() 
{
    Route::post('/cable', [CableController::class, 'store']);    
    Route::post('/post_cable', [CableController::class, 'post_cable']);
    Route::post('/modify_cable', [CableController::class, 'modify_cable']);
    Route::post('/delete_cable', [CableController::class, 'delete_cable']);
});

// -----------------------------------------
// RUTAS DISCO DURO (controller_disco_duro)
// -----------------------------------------

Route::get('/get_all_disco_duro', [controller_disco_duro::class, 'get_all_disco_duro']);
Route::get('/get_every_disco_duro', [controller_disco_duro::class, 'get_every_disco_duro']);
Route::get('/get_disco_duro_by_id', [controller_disco_duro::class, 'get_disco_duro_by_id']);
Route::get('/discosDuros', [controller_disco_duro::class, 'discosDurosPaginated']);

Route::middleware('auth:api')->group(function() {
    Route::post('/post_disco_duro', [controller_disco_duro::class, 'post_disco_duro']);
    Route::post('/modify_disco_duro', [controller_disco_duro::class, 'modify_disco_duro']);
    Route::post('/delete_disco_duro', [controller_disco_duro::class, 'delete_disco_duro']);
});

// -----------------------------------------
// RUTAS ALMACÉN (controller_almacen)
// -----------------------------------------

Route::middleware('auth:api')->group(function() {
    Route::get('/get_all_almacen', [controller_Almacen::class, 'index'] ?? ''); 
    Route::get('/almacen', [controller_Almacen::class, 'get_all_almacen']);
    
    // Ajustar si tu controlador y método difieren
});

// -----------------------------------------
// RUTAS TRANSPORTE (controller_transporte)
// -----------------------------------------

Route::get('/get_all_transportes', [controller_Transporte::class, 'getAllTransportes']);
Route::put('/transportes/{id}', [controller_Transporte::class, 'update']);
Route::middleware('auth:api')->post('/solicitar_transporte', [controller_Transporte::class, 'solicitarTransporte']);

// -----------------------------------------
// RUTAS RESIDUO (controller_residuo)
// -----------------------------------------

// Dependiendo de tu convención, singular o plural; aquí se usa '/residuo'
Route::get('/residuo', [controller_residuo::class, 'get_all_residuo']);
Route::get('/residuo/{id}', [controller_residuo::class, 'get_residuo_by_id']);
Route::post('/residuo', [controller_residuo::class, 'store']);
Route::put('/residuo/{id}', [controller_residuo::class, 'update_residuo']);
Route::delete('/residuo/{id}', [controller_residuo::class, 'delete_residuo']);

// Si tu controlador se llama ResiduoController, usa:
// Route::apiResource('residuo', ResiduoController::class)->middleware('auth:api');
// O bien agrupa con middleware si requieres autenticación:
// Route::middleware('auth:api')->group(function() {
//     Route::get('/residuo', [controller_residuo::class, 'get_all_residuo']);
//     ...
// });

// -----------------------------------------
// RUTAS CARGADOR (controller_cargador)
// -----------------------------------------

Route::post('/registrar_cargador', [controller_cargador::class, 'store']);
Route::get('/get_cargador_by_id', [controller_cargador::class, 'get_cargador_by_id']);
Route::middleware('auth:api')->group(function() {
    Route::get('/get_all_cargadores', [controller_cargador::class, 'get_all_cargadores']);
    Route::post('/update_cargador', [controller_cargador::class, 'update_cargador']);
    Route::post('/delete_cargador', [controller_cargador::class, 'delete_cargador']);
});

// -----------------------------------------
// RUTAS TAREA (controller_tarea)
// -----------------------------------------

Route::get('/tarea', [controller_tarea::class, 'index']);
Route::get('/tarea/urgente', [controller_tarea::class, 'urgente']);
Route::get('/tarea/sin_precio', [controller_tarea::class, 'listar_sin_precio']);
Route::middleware('auth:api')->group(function() {
    Route::post('/tarea/tasar', [controller_tarea::class, 'tasar_producto']);
});


// -----------------------------------------
// RUTAS PARÁMETROS (controller_parametros)
// -----------------------------------------

Route::prefix('parametros')->group(function() {
    Route::get('almacen',           [controller_parametros::class, 'almacen']);
    Route::get('tipo_entrada',      [controller_parametros::class, 'tipo_entrada']);
    Route::get('capacidad_ram',     [controller_parametros::class, 'capacidad_ram']);
    Route::get('metodo_despacho',   [controller_parametros::class, 'metodo_despacho']);
    Route::get('tipo_periferico',   [controller_parametros::class, 'tipo_periferico']);
    Route::get('tipo_ram',          [controller_parametros::class, 'tipo_ram']);
    Route::get('velocidad_ram',     [controller_parametros::class, 'velocidad_ram']);
    Route::get('tamano_ram',        [controller_parametros::class, 'tamano_ram']);
    Route::get('marca',             [controller_parametros::class, 'marca']);
    Route::get('disponibilidad',    [controller_parametros::class, 'disponibilidad']);
    Route::get('sistema_archivos',  [controller_parametros::class, 'sistema_archivos']);
    Route::get('tamano',            [controller_parametros::class, 'tamano']);
    Route::get('estado_compra',     [controller_parametros::class, 'estado_compra']);
    Route::get('estado_venta',      [controller_parametros::class, 'estado_venta']);
    Route::get('estado_recepcion',  [controller_parametros::class, 'estado_recepcion']);
    Route::post('estado_producto',  [controller_parametros::class, 'estado_producto']);
});


// -----------------------------------------
// RUTAS HERRAMIENTA (HerramientaController)
// -----------------------------------------

// Puedes agrupar bajo auth si necesario:
Route::apiResource('herramienta', HerramientaController::class);
// O explícitamente:
Route::middleware('auth:api')->group(function() {
    Route::get('/herramienta', [HerramientaController::class, 'index']);
    Route::post('/herramienta', [HerramientaController::class, 'store']);
    Route::put('/herramienta/{id}', [HerramientaController::class, 'update']);
    Route::delete('/herramienta/{id}', [HerramientaController::class, 'destroy']);
});

// -----------------------------------------
// RUTAS PRODUCTO (ProductoController)
// -----------------------------------------

Route::apiResource('producto', ProductoController::class);
// Si requieres auth:
Route::middleware('auth:api')->group(function() {
    Route::get('/producto', [ProductoController::class, 'index']);
    //Route::post('/producto', [ProductoController::class, 'store']);
    Route::put('/producto/{id}', [ProductoController::class, 'update']);
    Route::delete('/producto/{id}', [ProductoController::class, 'destroy']);
});
Route::post('/producto', [ProductoController::class, 'store']);

// -----------------------------------------
// RUTAS REPARACIÓN (ReparacionController)
// -----------------------------------------

Route::middleware('auth:api')->group(function() {
    Route::post('/reparacion', [ReparacionController::class, 'store']);
    Route::put('/reparacion/{id}', [ReparacionController::class, 'update']);
    Route::delete('/reparacion/{id}', [ReparacionController::class, 'destroy']);
    Route::get('/reparacion', [ReparacionController::class, 'index']);
});
// Ruta alternativa sin auth para listado (si permites):
Route::get('/get_all_reparacion', [ReparacionController::class, 'index']);

// -----------------------------------------
// RUTAS IMÁGENES, OTRAS
// -----------------------------------------

Route::get('/images/{nombreImagen}', function ($nombreImagen) {
    return response()->file(public_path('images/' . $nombreImagen));
});

// -----------------------------------------
// RUTAS UPGRADEO (UpgradeoController)
// -----------------------------------------

Route::middleware('auth:api')->group(function() {
    // upgradeo
    Route::get('/upgradeo', [UpgradeoController::class, 'index']);
    Route::post('/upgradeo', [UpgradeoController::class, 'store']);
    Route::put('/upgradeo/{id}', [UpgradeoController::class, 'update']);
    Route::delete('/upgradeo/{id}', [UpgradeoController::class, 'destroy']);
});

// -----------------------------------------
// OTRAS RUTAS PENDIENTES / EJEMPLO
// -----------------------------------------

// ... cualquier otra ruta específica


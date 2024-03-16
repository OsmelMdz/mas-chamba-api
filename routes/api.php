<?php

use App\Http\Controllers\Api\V1\CertificacionController;
use App\Http\Controllers\Api\V1\CursoController;
use App\Http\Controllers\Api\V1\ServicioController;
use App\Http\Controllers\Api\V1\PrestadordeServicioController;
use App\Http\Controllers\Api\V1\ZonaController;
use App\Http\Controllers\Api\V1\VisitanteController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Rutas para el control de autenticación y registro
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function () {
    //Ruta par cerrar sesion y destruir los tokens
    Route::post('logout', [AuthController::class, 'logout']);

    //Rutas get para ver los datos
    Route::apiResource('prestadores', PrestadordeServicioController::class);
    Route::apiResource('cursos', CursoController::class);
    Route::apiResource('servicios', ServicioController::class);
    Route::apiResource('certificaciones', CertificacionController::class);
    Route::apiResource('zonas', ZonaController::class);
    Route::apiResource('visitantes', VisitanteController::class);
    /* Route::apiResource('usuarios', UsuariosController::class);
    Route::apiResource('administradores',administradoresController::class); */

    //Rutas para crear de manera masiva
    Route::post('cursos/bulk', ['uses' => 'CursoController@bulkStore']);
    Route::post('servicios/bulk', ['uses' => 'ServicioController@bulkStore']);
    Route::post('certificaciones/bulk', ['uses' => 'CertificacionController@bulkStore']);
    Route::post('zonas/bulk', ['uses' => 'ZonaController@bulkStore']);
    Route::post('visitantes/bulk', ['uses' => 'VisitanteController@bulkStore']);

    //Rutas para crear
    Route::post('prestadores', [PrestadordeServicioController::class, 'store']);
    Route::post('cursos', [CursoController::class, 'store']);
    Route::post('servicios', [ServicioController::class, 'store']);
    Route::post('certificaciones', [CertificacionController::class, 'store']);
    Route::post('zonas', [ZonaController::class, 'store']);
    Route::post('visitantes', [VisitanteController::class, 'store']);


    //Rutas para actualizar todos los campos por id
    Route::put('prestadores/{id}', [PrestadordeServicioController::class, 'update']);
    Route::put('cursos/{id}', [CursoController::class, 'update']);
    Route::put('servicios/{id}', [ServicioController::class, 'update']);
    Route::put('certificaciones/{id}', [CertificacionController::class, 'update']);
    Route::put('zonas/{id}', [ZonaController::class, 'update']);
    Route::put('visitantes/{id}', [VisitanteController::class, 'update']);


    //Rutas para actualizar un campo en especifico por id
    Route::patch('prestadores/{id}', [PrestadordeServicioController::class, 'update']);
    Route::patch('cursos/{id}', [CursoController::class, 'update']);
    Route::patch('servicios/{id}', [ServicioController::class, 'update']);
    Route::patch('certificaciones/{id}', [CertificacionController::class, 'update']);
    Route::patch('zonas/{id}', [ZonaController::class, 'update']);

    //Rutas para eliminar por id
    Route::delete('prestadores/{id}', [PrestadordeServicioController::class, 'destroy']);
    Route::delete('cursos/{id}', [CursoController::class, 'destroy']);
    Route::delete('servicios/{servicio}', [ServicioController::class, 'destroy']);
    Route::delete('certificaciones/{id}', [CertificacionController::class, 'destroy']);
    Route::delete('zonas/{id}', [ZonaController::class, 'destroy']);
    Route::delete('visitantes/{id}', [VisitanteController::class, 'destroy']);
});

//Rutas que no necesitann token para crear el control de autenticación y registro por correo, contraseña y rol
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

<?php

use App\Http\Controllers\Api\V1\CertificacionController;
use App\Http\Controllers\Api\V1\CursoController;
use App\Http\Controllers\Api\V1\ServicioController;
use App\Http\Controllers\Api\V1\PrestadordeServicioController;
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
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware'=> 'auth:sanctum'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::apiResource('prestadores', PrestadordeServicioController::class);
    Route::apiResource('cursos', CursoController::class);
    Route::apiResource('servicios', ServicioController::class);
    Route::apiResource('certificaciones', CertificacionController::class);
    Route::apiResource('visitantes', VisitanteController::class);
    Route::post('cursos/bulk', ['uses' => 'CursoController@bulkStore']);
    Route::post('servicios/bulk', ['uses' => 'ServicioController@bulkStore']);
    Route::post('certificaciones/bulk', ['uses' => 'CertificacionController@bulkStore']);
});
//Rutas para el control de autenticación y registro
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

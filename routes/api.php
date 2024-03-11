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

/* Route::post('auth/register',[AuthController::class, 'create']);
Route::post('auth/login',[AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function () {
    Route::resource('prestadores', PrestadordeServicioController::class);
    Route::resource('visitantes', VisitanteController::class);
    Route::get('auth/logout',[AuthController::class,'logout']);
}); */
/*
Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']); */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum'], function () {
    Route::post('auth/register', [AuthController::class, 'register']);
    Route::post('auth/login', [AuthController::class, 'login']);

    //Protegido por autenticación
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('auth/logout', [AuthController::class, 'logout']);
    });

    //Rutas para el controlador de recursos de prestadores y visitantes
    Route::apiResource('prestadores', PrestadordeServicioController::class);
    Route::prefix('prestadores')->group(function () {
        Route::get('/{id}/visitantes', [PrestadordeServicioController::class, 'visitantes']);
    });

    Route::apiResource('visitantes', VisitanteController::class);

    //Ruta para la asignación de la visita a un prestador
    Route::put('visitas/{id}', [VisitanteController::class, 'asignarPrestador']);
    Route::apiResource('prestadores', PrestadordeServicioController::class);
    Route::apiResource('cursos', CursoController::class);
    Route::apiResource('servicios', ServicioController::class);
    Route::apiResource('certificaciones', CertificacionController::class);
    Route::apiResource('visitantes', VisitanteController::class);

    Route::post('cursos/bulk', ['uses' => 'CursoController@bulkStore']);
    Route::post('servicios/bulk', ['uses' => 'ServicioController@bulkStore']);
    Route::post('certificaciones/bulk', ['uses' => 'CertificacionController@bulkStore']);
});

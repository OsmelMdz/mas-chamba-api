<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/setup', function () {
    // Encuentra el usuario existente por su correo electrónico
    $user = \App\Models\User::where('email', 'cursos@mascapacitacion.com.mx')->first();

    // Si el usuario existe, genera tokens con permisos específicos
    if ($user) {
        $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']);
        $updateToken = $user->createToken('update-token', ['create', 'update']);
        $basicToken = $user->createToken('basic-token');

        return [
            'admin' => $adminToken->plainTextToken,
            'update' => $updateToken->plainTextToken,
            'basic' => $basicToken->plainTextToken,
        ];
    }

    // Si el usuario no existe, crea uno nuevo
    $credentials = [
        'email' => 'cursos@mascapacitacion.com.mx',
        'password' => 'MasCapacitacion2024xJV'
    ];

    $user = new \App\Models\User();
    $user->email = $credentials['email'];
    $user->password = Hash::make($credentials['password']);
    $user->save();

    // Autentica al usuario recién creado y genera tokens para él
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $adminToken = $user->createToken('admin-token', ['create', 'update', 'delete']);
        $updateToken = $user->createToken('update-token', ['create', 'update']);
        $basicToken = $user->createToken('basic-token');

        return [
            'admin' => $adminToken->plainTextToken,
            'update' => $updateToken->plainTextToken,
            'basic' => $basicToken->plainTextToken,
        ];
    }

    // Si no se pudo autenticar al usuario, retorna un mensaje de error
    return 'Error al configurar los permisos.';
});

<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrator;


class AuthController extends Controller
{
    /* public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:administradorGeneral,administradorUser,prestadordeServicio', // Asegúrate de que el rol sea 'administrador' o 'prestador de servicios'
        ]);

        $role = Role::where('nombre', $request->role)->first();

        if (!$role) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Asigna el rol al usuario
        $user->roles()->attach($role);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'Usuario creado con éxito',
        ]);
    }

 */

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:administradorGeneral,administradorBasico,prestadorDeServicio',
        ]);

        // Create the user
        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Find the role based on the role name
        $role = Role::where('nombre', $request->role)->first();

        // Attach the role to the user using the predefined relationship
        $user->roles()->attach($role->id);

        // Generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'Usuario creado con éxito',
        ]);
    }



    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Credenciales de inicio de sesión inválidas',
            ], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'message' => 'Inicio de sesión exitoso',
        ]);
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
            return response()->json([
                'status' => true,
                'message' => 'Usuario deslogueado con éxito'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Usuario no autenticado'
            ], 401);
        }
    }
}

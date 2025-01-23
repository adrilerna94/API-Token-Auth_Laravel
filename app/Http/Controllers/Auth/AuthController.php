<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

// debería hacerse un middleware para la validación
class AuthController extends Controller
{
    public function register(Request $request)
    {
        // la validación se debería hacer con un middleware
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]
        );

        if ($validator->fails()) {
            return response([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'errors' => $validator->errors()
            ], 400);
        }
        // a través del método Create de User creamos el usuario a través del body de la request
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // hashear contraseña
            // 'password' => bcrypt($request->password) // encriptar contraseña
        ]);

        return response()->json($user, 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|string|email',
                'password' => 'required|string'
            ]
        );
        if ($validator->fails()) {
            return response([
                'email' => $request->name,
                'password' => $request->password,
                'errors' => $validator->errors()
            ], 400);
        }
        if (!Auth::attempt($request->all())) {
            return response(['error' => 'Credentials not match'], 401);
        }
        // Auth::User() también válido
        // Creamos el token y le damos un nombre 'Auth token'
        // El token también se podría crear en el register
        $token = auth()->user()->createToken('Auth token');
        // response array
        $res = ['token' => $token, 'plain' => $token->plainTextToken];

        return response()->json($res);
    }
}

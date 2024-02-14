<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = [
                "success" => false,
                "data" => [],
                "errors" => $validator->messages()
            ];
            return response()->json($errors, 422);
        }

        $credentials = $validator->valid();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            /** @var User $user */
            $user = Auth::user();
            $name = $request->ip() . $user->email;

            // Generar un número aleatorio entre 200 y 500
            $random = rand(200, 500);

            // Crear el token con el email, la fecha y hora actual y el número aleatorio
            $tokenData = $user->email . date('Y-m-d H:i:s') . $random;

            // Encriptar el token en SHA1
            $token = hash('sha1', $tokenData);

            $user->tokens()->create([
                "name" => $name,
                "api_token" => $token,
                "limit" => 60
            ]);

            return response()->json([
                "success" => true,
                "data" => ["token" => $token],
                "message" => "token_generated",
            ], 200);
        }

        return response()->json([
            "success" => false,
            "data" => [],
            "message" => "wrong_credentials"
        ], 422);
    }

    public function logout(Request $request)
    {
        if ($request->user()->currentToken()->delete()) {
            return response()->json(null, Response::HTTP_OK);
        }
    }
}

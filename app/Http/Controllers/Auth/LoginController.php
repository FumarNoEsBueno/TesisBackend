<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    /**
     * Maneja el inicio de sesión y devuelve un token.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciales no válidas'], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('auth-token');
        $token     = $tokenResult->accessToken;
        $expiresAt = Carbon::now()->addWeek();

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'expires_at'   => $expiresAt->toDateTimeString(),
        ], 200);
    }

    /**
     * Revoca el token actual (logout).
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Sesión cerrada correctamente'], 200);
    }
}

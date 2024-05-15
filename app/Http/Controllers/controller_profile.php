<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class controller_profile extends Controller
{
    public function testeo(Request $request)
    {
        return response()->json($request->user());
    }

    public function profile(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if(!Auth::attempt($credentials))
            return response()->json("Credenciales no validas", 500);
        $user = $request->user();

        $token = $user->createToken('auth-token');
        $token->expires_at = Carbon::now()->addWeeks(1);

        $tokenResult = $token->accessToken;

        return response()->json(
            $tokenResult,
        );
    }
}

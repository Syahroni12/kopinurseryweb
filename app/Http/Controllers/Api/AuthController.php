<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function gaslogin(Request $request)
    {
        $request->validate([
            'identifier' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('no_telfon', $request->identifier)
            ->orWhere('email', $request->identifier)
            ->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('API Token')->plainTextToken;
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_at' => now()->addMinutes(60)->toDateTimeString(),
                    'user' => $user,
                    'message' => 'Login Berhasil',
                ], 200);
            } else {
                return response()->json(['message' => 'Password anda salah.'], 401);
            }
        } else {
            return response()->json(['message' => 'Username pengguna tidak ditemukan.'], 401);
        }
    }
}

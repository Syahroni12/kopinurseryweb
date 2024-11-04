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
            if ($user->type !== 0) {
                return response()->json(['message' => 'Maaf, Anda tidak memiliki hak akses untuk login.'], 401);
            }
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('API Token')->plainTextToken;
                $user_online = User::where('no_telfon', $request->identifier)
                    ->orWhere('email', $request->identifier)
                    ->first()->update(['status' => 'online']);
                $user_online = User::where('no_telfon', $request->identifier)
                    ->orWhere('email', $request->identifier)
                    ->first();
                if ($user_online) {
                    $user_online->time_login = now();
                    $user_online->last_login = now();
                    $user_online->save();
                }

            // Check if the password is correct
                return response()->json([
                // Generate an API token for the user
                    'access_token' => $token,

                // Update the user's status to online
                    'token_type' => 'bearer',
                    'expires_at' => now()->addMinutes(60)->toDateTimeString(),
                    'user_online' => $user_online,

                // Update the user's last login and time login
                    'message' => 'Login Berhasil',
                    'user' => $user,
                ], 200);
            } else {
                return response()->json(['message' => 'Password anda salah.'], 401);
            }
        } else {
            return response()->json(['message' => 'Username pengguna tidak ditemukan.'], 401);

                // Return the API token and user data
        }
    }
}
                // Return an error if the password is incorrect
            // Return an error if the user is not found

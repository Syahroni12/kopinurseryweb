<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {

        return view('auth.login');
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_telfon' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal', $validator->messages());
            return redirect()->back()->withInput();
        }

        $credentials = [
            "no_telfon" => $request->no_telfon,
            "password" => $request->password
        ];


        if (auth()->attempt($credentials)) {

            Alert::success('Success', 'Login Berhasil di lakukan');
            return redirect()->route('dashboard');
        } else {
            Alert::error('Gagal', 'No. Telfon / Password salah');
            return redirect()->back()->withInput();
        }

        try {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                Alert::success('Success', 'Login Berhasil di lakukan');
                return redirect()->intended('dashboard');
            } else {
                Alert::error('Gagal', "email atau password salah");
                return back();
            }
        } catch (\Throwable $th) {
        }
    }

    public function logout(Request $request)
    {
        if ($request->user()->currentAccessToken()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'message' => 'Logout berhasil dilakukan'
            ], 200);
        } else {
            return response()->json([
                'message' => 'User sudah logout atau token tidak ditemukan'
            ], 401);
        }
    }

    public function logoutt(Request $request)
    {
        //fungsi logout


        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Alert::success('Success', 'Logout Berhasil di lakukan');
        return redirect()->route('login');
    }
}

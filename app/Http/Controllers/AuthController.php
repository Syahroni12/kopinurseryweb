<?php

namespace App\Http\Controllers;

use App\Models\ResetPaswordOtp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
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

            Alert::success('success', 'Login Berhasil di lakukan');
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

    public function forgotpass()
    {
        return view('auth.forgot-password');
    }
    public function forgotpassact(Request $request)
    {
        $validate = $request->validate([
            'no_telfon' => 'required|numeric|exists:users',
        ]);
        $user = User::with('pengguna')->where('no_telfon', $validate['no_telfon'])->first();

        if ($user) {
            $OTP = rand(1000, 9999);
            $resetPassword = ResetPaswordOtp::where('no_telfon', $validate['no_telfon'])->first();
            if ($resetPassword) {
                $resetPassword->otp = $OTP;
                $resetPassword->expired_at = now()->addMinutes(2);
                $resetPassword->save();
            } else {
                $resetPassword = new ResetPaswordOtp();
                $resetPassword->id_user = $user->id;
                $resetPassword->no_telfon = $user->no_telfon;
                $resetPassword->otp = $OTP;
                $resetPassword->expired_at = now()->addMinutes(2);
                $resetPassword->save();
            }
            $token = 'kYjrG5tSaij9kXNG2dYf';
            $telfon = $validate['no_telfon'];
            $encrypt_telfon = Crypt::encryptString($telfon);
            $nama_user = $user->pengguna->nama;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' =>     $resetPassword->no_telfon,
                    'message' => "*RESET PASSWORD WEB KOPi nyrseri *\n\nHai *$nama_user*,\n\nKami ingin memberitahu Anda bahwa permintaan reset password Anda telah kami terima. Kode OTP Anda untuk mereset password adalah *$OTP*. Silakan gunakan kode ini dalam aplikasi untuk mengatur ulang kata sandi Anda.\n\nJangan ragu untuk menghubungi tim dukungan kami jika Anda mengalami kesulitan atau memiliki pertanyaan lebih lanjut. Kami selalu siap membantu Anda.\n\nTerima kasih atas kepercayaan Anda pada *Kopi nuserry web*.",
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $token,
                ),
            ));

            $response_sms = curl_exec($curl);

            curl_close($curl);

            Alert::success('Kode OTP verifikasi terkirim, cek pesan WhatsApp anda!', 'success');
            return redirect()->route('otp-password', ['no_telfon' => $encrypt_telfon]);
        } else {
            // Alert::toast('Nomor telepon tidak ditemukan', 'error');
            Alert::error('Error', 'Nomor telepon tidak ditemukan');
            return redirect()->back();
        }
    }

    public function otppass($no_telfon)
    {
        return view('auth.otp-password', compact('no_telfon'));
    }
    public function checkOTP($no_telfon, Request $request)
    {
        $no_telfon_dec = Crypt::decryptString($no_telfon);

        $otpCode = implode('', $request->input('otp'));
        // dump($otpCode);
        $kode_otp = ResetPaswordOtp::where('no_telfon', $no_telfon_dec)->orderBy('created_at', 'desc')->first();
        if ($kode_otp && $kode_otp->otp === $otpCode) {
            if (Carbon::now()->gt($kode_otp->expired_at)) {
                ResetPaswordOtp::where('no_telfon', $kode_otp->no_telfon)->delete();
                Alert::error('Error', 'Kode OTP yang Anda masukkan telah kadaluarsa');
                return back()->with('error', 'Kode OTP yang Anda masukkan telah kadaluarsa');
            } else {
                Alert::success('success', 'Kode OTP Berhasil di Verifikasi');
                return redirect()->route('reset-password', ['no_telfon' => $no_telfon]);
            }
        } else {
            Alert::error('Error', 'Kode OTP yang Anda masukkan tidak sesuai');
            return back()->with('error', 'Kode OTP yang Anda masukkan tidak sesuai');
        }
    }


    public function kirimulangotp($no_telfon)
    {

        $no_telfon_dec = Crypt::decryptString($no_telfon);

        $user = User::with('pengguna')->where('no_telfon', $no_telfon_dec)->first();
        if ($user) {

            $OTP = rand(1000, 9999);
            $resetPassword = ResetPaswordOtp::where('no_telfon', $no_telfon_dec)->first();
            if ($resetPassword) {
                $resetPassword->otp = $OTP;
                $resetPassword->expired_at = now()->addMinutes(2);
                $resetPassword->save();
            } else {
                $resetPassword = new ResetPaswordOtp();
                $resetPassword->id_user = $user->id;
                $resetPassword->no_telfon = $user->no_telfon;
                $resetPassword->otp = $OTP;
                $resetPassword->expired_at = now()->addMinutes(2);
                $resetPassword->save();
            }

            $token = 'kYjrG5tSaij9kXNG2dYf';
            $telfon =   $resetPassword->no_telfon;
            $encrypt_telfon = Crypt::encryptString($telfon);
            $nama_user = $user->pengguna->nama;

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' =>     $resetPassword->no_telfon,
                    'message' => "*RESET PASSWORD WEB KOPi nyrseri *\n\nHai *$nama_user*,\n\nKami ingin memberitahu Anda bahwa permintaan reset password Anda telah kami terima. Kode OTP Anda untuk mereset password adalah *$OTP*. Silakan gunakan kode ini dalam aplikasi untuk mengatur ulang kata sandi Anda.\n\nJangan ragu untuk menghubungi tim dukungan kami jika Anda mengalami kesulitan atau memiliki pertanyaan lebih lanjut. Kami selalu siap membantu Anda.\n\nTerima kasih atas kepercayaan Anda pada *Kopi nuserry web*.",
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $token,
                ),
            ));

            $response_sms = curl_exec($curl);

            curl_close($curl);

            Alert::success('Kode OTP verifikasi terkirim, cek pesan WhatsApp anda!', 'success');
            return redirect()->route('otp-password', ['no_telfon' => $encrypt_telfon]);
        } else {
            // Alert::toast('Nomor telepon tidak ditemukan', 'error');
            Alert::error('Error', 'Nomor telepon tidak ditemukan');
            return back()->with('error', 'Nomor telepon tidak ditemukan');
        }
    }



    public function resetpass($no_telfon)
    {

        return view('auth.reset-password', compact('no_telfon'));
    }
    public function resetpassact($no_telfon, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            Alert::error($messages)->flash();
            return back()->withErrors($validator)->withInput();
        }
        $no_telfon_dec = Crypt::decryptString($no_telfon);
        $user = User::with('pengguna')->where('no_telfon', $no_telfon_dec)->first();
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            Alert::success('Success', 'Password Berhasil di reset');
            return redirect()->route('login');
        }
    }
}

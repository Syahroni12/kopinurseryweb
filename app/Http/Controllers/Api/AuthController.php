<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\ResetPaswordOtp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
                $pengguna = Pengguna::where('id_user', $user->id)->first();
                $token = $user->createToken('API Token')->plainTextToken;
                return response()->json([
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_at' => now()->addMinutes(60)->toDateTimeString(),
                    'user' => $user,
                    'pengguna' => $pengguna,
                    'message' => 'Login Berhasil',
                ], 200);
            } else {
                return response()->json(['message' => 'Password anda salah.'], 401);
            }
        } else {
            return response()->json(['message' => 'Username pengguna tidak ditemukan.'], 401);
        }
    }
    public function checkToken(Request $request)
    {
        if (Auth::check()) {
            return response()->json([
                'message' => 'Token valid',
                'user' => Auth::user()
            ]);
        }

        return response()->json([
            'message' => 'Token tidak valid atau telah kedaluwarsa'
        ], 401);
    }

    public function updateprofile($id_user, Request $request)
    {
        if ($request->hasFile('foto')) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'no_telfon' => [
                    'required',
                    Rule::unique('users', 'no_telfon')->ignore($id_user), // pengecualian untuk ID pengguna saat ini
                ],
                'email' => [
                    'nullable',
                    Rule::unique('users', 'email')->ignore($id_user), // pengecualian untuk ID pengguna saat ini
                ],
                'alamat' => 'required',
                'deskripsi' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'no_telfon' => [
                    'required',
                    Rule::unique('users', 'no_telfon')->ignore($id_user), // pengecualian untuk ID pengguna saat ini
                ],
                'alamat' => 'required',
                'deskripsi' => 'required',
            ]);
        }

        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $messages,
            ], 422);
        }
        $user = User::findOrFail($id_user);
        $user->no_telfon = $request->no_telfon;
        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        $pengguna = Pengguna::where('id_user', $id_user)->first();
        $pengguna->nama = $request->nama;
        $pengguna->alamat = $request->alamat;
        $pengguna->deskripsi = $request->deskripsi;

        if ($request->hasFile('foto')) {
            if ($pengguna->foto != "avatar.png") {
                $file = public_path() . '/foto_profil/' . $pengguna->foto;
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            $fileName = time() . '.' . $request->file('foto')->getClientOriginalExtension(); //mengambil ekstensi file

            $request->file('foto')->move(public_path() . '/foto_profil', $fileName);

            $pengguna->foto = $fileName;
        }
        $pengguna->save();

        return response()->json([
            'message' => 'Data Berhasil di Update',
            'user' => $user,
            'pengguna' => $pengguna
        ]);
    }


    public function verifikasiPhone(Request $request)
    {
        $validate = $request->validate([
            'no_telfon' => 'required|numeric|exists:users,no_telfon',
        ], [
            'no_telfon.exists' => 'Nomor telepon tidak terdaftar.'
        ]);

        try {
            $user = User::with('pengguna')->where('no_telfon', $validate['no_telfon'])->first();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Nomor telepon tidak terdaftar atau tidak memiliki izin untuk menerima OTP.'
                ], 404);
            }

            $OTP = rand(1000, 9999);
            $cek = ResetPaswordOtp::where('no_telfon', $validate['no_telfon'])->first();

            if ($cek) {
                $resetPasswordOtp = $cek;
            } else {
                $resetPasswordOtp = new ResetPaswordOtp();
            }

            $resetPasswordOtp->id_user = $user->id;
            $resetPasswordOtp->no_telfon = $user->no_telfon;
            $resetPasswordOtp->otp = $OTP;
            $resetPasswordOtp->expired_at = now()->addMinutes(2);
            $resetPasswordOtp->save();

            $token = 'kYjrG5tSaij9kXNG2dYf';
            $telfon = $validate['no_telfon'];
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
                    'target' => $telfon,
                    'message' => "*RESET PASSWORD Nursery Web*\n\nHai *$nama_user*,\n\nKami ingin memberitahu Anda bahwa permintaan reset password Anda telah kami terima. Kode OTP Anda untuk mereset password adalah *$OTP*. Silakan gunakan kode ini dalam aplikasi untuk mengatur ulang kata sandi Anda.\n\nTerima kasih atas kepercayaan Anda pada *Nursery Web*."
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $token,
                ),
            ));

            $response_sms = curl_exec($curl);
            $curl_error = curl_error($curl);
            curl_close($curl);

            if ($response_sms) {
                return response()->json([
                    'status' => 'success',
                    'message' => "OTP berhasil dikirim ke nomor telepon yang terdaftar: $telfon."
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal mengirim OTP. Silakan coba lagi. Error: ' . $curl_error
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function verifikasiOTP($no_telfon, Request $request)
    {
        try {
            Log::info("Memulai verifikasi OTP untuk nomor: " . $no_telfon);

            $name_form = 'otp';
            $messages = [
                'otp.required' => 'Kode OTP harus diisi.',
                'otp.numeric' => 'Kode OTP harus berupa angka.',
                'otp.exists' => 'Kode OTP tidak valid.',
            ];

            $validate = $request->validate([
                $name_form => 'required|numeric|exists:reset_pasword_otps,otp',
            ], $messages);

            $check_otp_user = ResetPaswordOtp::where('no_telfon', $no_telfon)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($check_otp_user && $check_otp_user->otp == $validate[$name_form]) {
                if (Carbon::now()->gt($check_otp_user->expired_at)) {
                    ResetPaswordOtp::where('no_telfon', $no_telfon)->delete();
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Kode OTP yang Anda masukkan telah kadaluarsa.'
                    ], 400);
                } else {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Kode OTP Berhasil di Verifikasi'
                    ], 200);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kode OTP yang Anda masukkan tidak sesuai.'
                ], 400);
            }
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan dalam mengakses database. ' . $e->getMessage()
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memverifikasi OTP: ' . $e->getMessage()
            ], 500);
        }
    }

    public function resetPassword($no_telfon, Request $request)
    {
        $name_form = ['password', 'confirm-password'];
        $message = [
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter.',
            'confirm-password.required' => 'Konfirmasi password harus diisi.',
            'confirm-password.min' => 'Konfirmasi password harus terdiri dari minimal 8 karakter.',
        ];
        $validate = $request->validate([
            'password' => 'required|min:8',
            'confirm-password' => 'required|min:8',
        ], $message);
        $table_users = User::where('no_telfon', $no_telfon)->first();

        if ($validate[$name_form[1]] !== $validate[$name_form[0]]) {
            return response()->json([
                'status' => 'error',
                'message' => 'Konfirmasi password tidak cocok!'
            ], 400);
        }
        if ($table_users) {
            $table_users->update([
                'password' => bcrypt($validate[$name_form[0]]),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Password anda telah diperbarui!'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan!'
            ], 400);
        }
    }
    public function kirimUlangOTP($no_telfon)
    {
        Log::info("Memulai proses kirim ulang OTP untuk nomor: $no_telfon");
        $data_user = User::where('no_telfon', $no_telfon)->first();

        if ($data_user) {
            Log::info("User ditemukan: $data_user->name dengan nomor telepon: $no_telfon");
            $OTP = rand(1000, 9999);
            Log::info("OTP yang dibuat: $OTP");

            $existing_otp = ResetPaswordOtp::where('no_telfon', $no_telfon)
                ->first();

            if ($existing_otp) {
                Log::info("OTP lama ditemukan untuk nomor telepon $no_telfon, menghapus entri lama.");
                $existing_otp->delete();
            } else {
                Log::info("Tidak ada OTP yang masih berlaku untuk nomor telepon $no_telfon.");
            }
            $ResetPaswordOtp = new ResetPaswordOtp();
            $ResetPaswordOtp->id_user = $data_user->id;
            $ResetPaswordOtp->no_telfon = $data_user->no_telfon;
            $ResetPaswordOtp->otp = $OTP;
            $ResetPaswordOtp->expired_at = now()->addMinutes(2);
            $ResetPaswordOtp->save();

            Log::info("OTP berhasil disimpan ke database dengan waktu kadaluarsa: " . now()->addMinutes(2));
            $token = 'kYjrG5tSaij9kXNG2dYf';
            $telfon = $data_user->no_telfon;
            $nama_user = $data_user->name;
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $telfon,
                    'message' => "*RESET PASSWORD Nursery Web*\n\nHai *$nama_user*,\n\nKami ingin memberitahu Anda bahwa permintaan reset password Anda telah kami terima. Kode OTP Anda untuk mereset password adalah *$OTP*. Silakan gunakan kode ini dalam aplikasi untuk mengatur ulang kata sandi Anda.\n\nJangan ragu untuk menghubungi tim dukungan kami jika Anda mengalami kesulitan atau memiliki pertanyaan lebih lanjut. Kami selalu siap membantu Anda.\n\nTerima kasih atas kepercayaan Anda pada *Nursery Web*.",
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $token,
                ),
            ));
            $response_sms = curl_exec($curl);
            if (curl_errno($curl)) {
                $curl_error = curl_error($curl);
                Log::error("CURL Error: $curl_error");
                curl_close($curl);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal mengirim OTP ulang, harap coba lagi.'
                ], 500);
            }

            curl_close($curl);
            Log::info("Response dari API pengiriman SMS: $response_sms");
            if ($response_sms) {
                Log::info("OTP berhasil dikirim ulang ke nomor telepon: $telfon.");
                return response()->json([
                    'status' => 'success',
                    'message' => "OTP berhasil dikirim ulang ke nomor telepon yang terdaftar: $telfon."
                ], 200);
            } else {
                Log::error("Gagal mengirim OTP ulang untuk nomor telepon: $telfon.");
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal mengirim OTP ulang, harap coba lagi.'
                ], 500);
            }
        } else {
            Log::warning("Nomor telepon tidak terdaftar: $no_telfon");
            return response()->json([
                'status' => 'error',
                'message' => 'Nomor telepon tidak terdaftar.'
            ], 404);
        }
    }
}

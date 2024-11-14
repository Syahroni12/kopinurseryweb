<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use App\Models\ResetPaswordOtp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

        // Jika tidak valid, mengembalikan respons gagal
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
            $user = User::with('pengguna')->where('no_telfon', $validate['no_telfon'])
                ->first();

            $cek = ResetPaswordOtp::where('no_telfon', $validate['no_telfon'])->first();
            if ($cek) {
                if ($user) {
                    $OTP = rand(1000, 9999);


                    $cek->id_user = $user->id;
                    $cek->no_telfon = $user->no_telfon;
                    $cek->otp = $OTP;
                    $cek->expired_at = now()->addMinutes(2);
                    $cek->save();

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
                            'message' => "*RESET PASSWORD Nursery Web*\n\nHai *$nama_user*,\n\nKami ingin memberitahu Anda bahwa permintaan reset password Anda telah kami terima. Kode OTP Anda untuk mereset password adalah *$OTP*. Silakan gunakan kode ini dalam aplikasi untuk mengatur ulang kata sandi Anda.\n\nJangan ragu untuk menghubungi tim dukungan kami jika Anda mengalami kesulitan atau memiliki pertanyaan lebih lanjut. Kami selalu siap membantu Anda.\n\nTerima kasih atas kepercayaan Anda pada *Nursery Web*.",
                        ),
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: ' . $token,
                        ),
                    ));

                    $response_sms = curl_exec($curl);
                    curl_close($curl);

                    if ($response_sms) {
                        return response()->json([
                            'status' => 'success',
                            'message' => "OTP berhasil dikirim ke nomor telepon yang terdaftar: $telfon."
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'blok'
                        ], 500);
                    }
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Nomor telepon tidak terdaftar atau tidak memiliki izin untuk menerima OTP.'
                    ], 404);
                }
            } else {
                if ($user) {
                    $OTP = rand(1000, 9999);

                    $ResetPaswordOtp = new ResetPaswordOtp();
                    $ResetPaswordOtp->id_user = $user->id;
                    $ResetPaswordOtp->no_telfon = $user->no_telfon;
                    $ResetPaswordOtp->otp = $OTP;
                    $ResetPaswordOtp->expired_at = now()->addMinutes(2);
                    $ResetPaswordOtp->save();

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
                            'message' => "*RESET PASSWORD Nursery Web*\n\nHai *$nama_user*,\n\nKami ingin memberitahu Anda bahwa permintaan reset password Anda telah kami terima. Kode OTP Anda untuk mereset password adalah *$OTP*. Silakan gunakan kode ini dalam aplikasi untuk mengatur ulang kata sandi Anda.\n\nJangan ragu untuk menghubungi tim dukungan kami jika Anda mengalami kesulitan atau memiliki pertanyaan lebih lanjut. Kami selalu siap membantu Anda.\n\nTerima kasih atas kepercayaan Anda pada *Nursery Web*.",
                        ),
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: ' . $token,
                        ),
                    ));

                    $response_sms = curl_exec($curl);
                    curl_close($curl);

                    if ($response_sms) {
                        return response()->json([
                            'status' => 'success',
                            'message' => "OTP berhasil dikirim ke nomor telepon yang terdaftar: $telfon."
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'blok'
                        ], 500);
                    }
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Nomor telepon tidak terdaftar atau tidak memiliki izin untuk menerima OTP.'
                    ], 404);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // fungsi verifikasi otp ini digunakan seteleh user melewati tahap
    // check pengiriman otp dengan menggunakan nomor telephone yang terdaftar
    public function verifikasiOTP($no_telfon, Request $request)
    {
        // variable name yang harus sama dengan textfield
        // pada kode flutter yang digunakan untuk mencocokkan request
        $name_form = 'otp';

        // digunakan untuk custom pesan error pada validasi input
        $messages = [
            'otp.required' => 'Kode OTP harus diisi.',
            'otp.numeric' => 'Kode OTP harus berupa angka.',
            'otp.exists' => 'Kode OTP tidak valid.',
        ];

        // melakukan validasi berdasarkan pengiriman request dari input
        // dalam variable $name_form
        $validate = $request->validate([
            $name_form => 'required|numeric|exists:reset_password,otp',
        ], $messages);

        // melakukan check apakah otp yang diinputkan sesuai dengan otp dan nomor telephone yang ada pada table reset_password
        // dan data yang diambil adalah data terbaru dengan menggunakan orderBy desc
        $check_otp_user = ResetPaswordOtp::where('no_telfon', $no_telfon)->orderBy('created_at', 'desc')->first();

        // melakukan pengecekan apakah $check_otp_user ada dan apakah kolom otp
        // sama dengan $validate[$name_form] yang di inputkan oleh user
        if ($check_otp_user && $check_otp_user->otp == $validate[$name_form]) {

            // melakukan check apakah kode otp yang dimasukkan expired atau tidak
            if (Carbon::now()->gt($check_otp_user->expired_at)) {

                // jika check sesuai maka hapus seluruh data otp yang
                // terkait dengan no_telfon user
                ResetPaswordOtp::where('no_telfon', $no_telfon)->delete();

                // berikan respons pesan bahwa kode otp telah kadaluarsa
                return response()->json([
                    'status' => 'error',
                    'message' => 'Kode OTP yang Anda masukkan telah kadaluarsa.'
                ], 400);
            } else {
                // kirimkan respon bahwa kode otp berhasil di verifikasi
                return response()->json([
                    'status' => 'success',
                    'message' => 'Kode OTP Berhasil di Verifikasi'
                ], 200);
            }
        } else {
            // berikan respons pesan bahwa kode otp yang dimasukkan tidak sesuai
            return response()->json([
                'status' => 'error',
                'message' => 'Kode OTP yang Anda masukkan tidak sesuai.'
            ], 400);
        }
    }

    // fungsi reset password ini digunakan seteleh user melewati tahap
    // pengecekan otp dan melewati tahap verifikasi otp
    public function ResetPaswordOtp($no_telfon, Request $request)
    {
        // variable name yang harus sama dengan textfield
        // pada kode flutter yang digunakan untuk mencocokkan request
        $name_form = ['password', 'confirm-password'];

        // custom pesan error untuk input
        $message = [
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password harus terdiri dari minimal 8 karakter.',
            'confirm-password.required' => 'Konfirmasi password harus diisi.',
            'confirm-password.min' => 'Konfirmasi password harus terdiri dari minimal 8 karakter.',
        ];

        // validasi dari name input dengan mencocokkan kedalam
        // kolom table users
        $validate = $request->validate([
            'password' => 'required|min:8',
            'confirm-password' => 'required|min:8',
        ], $message);

        // buat variable yang menampung isi untuk mengambil data
        // dari tabe users sesuai dengan no_telfon
        $table_users = User::where('no_telfon', $no_telfon)->first();

        // check apakah confirmasi password sama dengan password
        if ($validate[$name_form[1]] !== $validate[$name_form[0]]) {
            // kirimkan respon bahwa konfirmasi password tidak cocok
            return response()->json([
                'status' => 'error',
                'message' => 'Konfirmasi password tidak cocok!'
            ], 400);
        }

        // check apakah data user ada
        if ($table_users) {
            // data user ada maka update password dengan fungsi bycript / hash
            $table_users->update([
                'password' => bcrypt($validate[$name_form[0]]),
            ]);

            // kirimkan respon bahwa password anda telah diperbarui
            return response()->json([
                'status' => 'success',
                'message' => 'Password anda telah diperbarui!'
            ], 200);
        } else {
            // kirimkan respon bahwa user tidak ditemukan
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak ditemukan!'
            ], 400);
        }
    }

    // fungsi untuk tombol kirim ulang kode otp
    function kirimUlangOTP($no_telfon)
    {
        // Mengambil data user berdasarkan no_telfon
        $data_user = User::where('no_telfon', $no_telfon)->first();

        // Check apakah ada data user dengan nomor telepon yang diberikan
        if ($data_user) {
            // Generate OTP baru
            $OTP = rand(1000, 9999);

            // Simpan OTP ke dalam tabel reset_passwords
            $ResetPaswordOtp = new ResetPaswordOtp();
            $ResetPaswordOtp->id_user = $data_user->id;
            $ResetPaswordOtp->no_telfon = $data_user->no_telfon;
            $ResetPaswordOtp->otp = $OTP;
            $ResetPaswordOtp->expired_at = now()->addMinutes(2);
            $ResetPaswordOtp->save();

            // Konfigurasi untuk mengirim pesan OTP melalui API SMS
            $token = 'kYjrG5tSaij9kXNG2dYf';
            $telfon = $data_user->no_telfon;
            $nama_user = $data_user->name;

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
                    'message' => "*RESET PASSWORD Nursery Web*\n\nHai *$nama_user*,\n\nKami ingin memberitahu Anda bahwa permintaan reset password Anda telah kami terima. Kode OTP Anda untuk mereset password adalah *$OTP*. Silakan gunakan kode ini dalam aplikasi untuk mengatur ulang kata sandi Anda.\n\nJangan ragu untuk menghubungi tim dukungan kami jika Anda mengalami kesulitan atau memiliki pertanyaan lebih lanjut. Kami selalu siap membantu Anda.\n\nTerima kasih atas kepercayaan Anda pada *Nursery Web*.",
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $token,
                ),
            ));

            // Kirim permintaan untuk mengirim pesan OTP
            $response_sms = curl_exec($curl);

            // Tutup koneksi CURL
            curl_close($curl);

            // Periksa apakah pengiriman OTP berhasil
            if ($response_sms) {
                // Jika berhasil, kirim respons JSON dengan status 'success'
                return response()->json([
                    'status' => 'success',
                    'message' => "OTP berhasil dikirim ulang ke nomor telepon yang terdaftar: $telfon."
                ], 200);
            } else {
                // Jika gagal mengirim OTP, kirim respons JSON dengan status 'error'
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gagal mengirim OTP ulang, harap coba lagi.'
                ], 500);
            }
        } else {
            // Jika nomor telepon tidak terdaftar, kirim respons JSON dengan status 'error'
            return response()->json([
                'status' => 'error',
                'message' => 'Nomor telepon tidak terdaftar.'
            ], 404);
        }
    }
}

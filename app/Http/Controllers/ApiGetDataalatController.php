<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Diagnosapenyakitdaun;
use App\Models\Monicontrolling;
use App\Models\Otomatis;
use App\Models\Pengguna;
use App\Models\User;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ApiGetDataalatController extends Controller
{

    public function dataDiagnosaDetail($id){
        try{
            if($id){
                $get_detail = Diagnosapenyakitdaun::where('id', $id)->first();
                return response()->json([
                    'status' => 'success',
                    'data' => $get_detail
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan'
                ]);
            }
         }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteDataDiagnosa($id)
    {
        try {
            $diagnosa = Diagnosapenyakitdaun::find($id);
            if (!$diagnosa) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data diagnosa tidak ditemukan'
                ], 404);
            }
            $diagnosa->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Data diagnosa berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function index($id)
    {
        try {
            $data = Monicontrolling::where('id_alat', $id)
                ->latest()
                ->first();

            if (!$data) {
                return response()->json([
                    'message' => 'Data not found'
                ], 404);
            }
            $responseData = [
                'id' => $data->id,
                'id_alat' => $data->id_alat,
                'nilai_humidity' => $data->nilai_humidity,
                'nilai_temperature' => $data->nilai_temperature,
                'created_at' => $data->created_at,
                'updated_at' => $data->updated_at
            ];

            return response()->json($responseData, 200, [], JSON_NUMERIC_CHECK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function dataDiagnosa($params, $id = null)
    {
        try {
            if ($id !== null) {
                // Jika $id ada, ambil data berdasarkan ID
                $data_diagnosa = Diagnosapenyakitdaun::find($id);

                if (!$data_diagnosa) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Data tidak ditemukan'
                    ], 404);
                }

                return response()->json([
                    'status' => 'success',
                    'data' => $data_diagnosa
                ]);
            }
            switch ($params) {
                case 'terbaru':
                    $data_diagnosa = Diagnosapenyakitdaun::latest()->first();
                    break;

                case 'sejamlalu':
                    // Menampilkan semua data yang dibuat dalam satu jam terakhir
                    $data_diagnosa = Diagnosapenyakitdaun::where('created_at', '>=', Carbon::now()->subHour())
                        ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan waktu dibuat terbaru
                        ->get();
                    break;

                case 'semua':
                    $data_diagnosa = Diagnosapenyakitdaun::get();
                    break;

                case 'miner':
                    $data_diagnosa = Diagnosapenyakitdaun::where('diagnosa', 'miner')->get();
                    break;

                case 'phoma':
                    $data_diagnosa = Diagnosapenyakitdaun::where('diagnosa', 'phoma')->get();
                    break;

                case 'nodisease':
                case 'health':
                    $data_diagnosa = Diagnosapenyakitdaun::whereIn('diagnosa', ['nodisease', 'health'])->get();
                    break;

                case 'rust':
                    $data_diagnosa = Diagnosapenyakitdaun::where('diagnosa', 'rust')->get();
                    break;

                    case 'recent':
                        $data_diagnosa = Diagnosapenyakitdaun::orderBy('created_at', 'desc')->limit(10)->get();
                        break;

                default:
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Parameter tidak valid'
                    ], 400);
            }

            return response()->json([
                'status' => 'success',
                'data' => $data_diagnosa
            ]);
        } catch (\Exception $error) {
            return response()->json([
                'status' => 'error',
                'message' => $error->getMessage()
            ], 500);
        }
    }

    public function senddata(Request $request)
    {
        // Validasi input
        // $validatedData = $request->validate([
        //     'id_alat' => 'required|string',
        //     'temperature' => 'required|numeric',
        //     'humidity' => 'required|numeric',
        // ]);

        // Simpan data monitoring
        // $monitoring = new Monicontrolling();
        $temperature = $request->input('temperature');
        $humidity = $request->input('humidity');
        $id_alat = $request->input('id_alat');

        // Menangkap data dari request yang sudah divalidasi
        $date = Carbon::now();
        try {
            $data =   Monicontrolling::create([
                'id_alat' => $id_alat,
                'nilai_temperature' => $temperature,
                'nilai_humidity' => $humidity,
                'created_at' => $date,
                'updated_at' => $date,
            ]);


            // $monitoring->save();
            // Kembalikan respons
            return response()->json([
                'message' => 'Monitoring data saved successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error saving monitoring data: ' . $e->getMessage(),
            ], 500);
        }
    }



    public function apiLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_telfon' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = [
            "no_telfon" => $request->no_telfon,
            "password" => $request->password,
        ];

        try {
            if (auth()->attempt($credentials)) {
                // $request->session()->regenerate();
                $user = auth()->user();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Login successful',
                    'user' => $user,
                    // 'token' => $user->createToken('API Token')->plainTextToken, // Requires Laravel Sanctum or Passport
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No. Telfon or password is incorrect',
                ], 401);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Logout successful'], 200);
    }

    public function chart()
    {
        $tanggal_sekarang = Carbon::now();
        $seminggu_lalu = Carbon::now()->subWeek();

        $data = Monicontrolling::whereBetween('created_at', [$seminggu_lalu, $tanggal_sekarang])->selectRaw('created_at as tanggal, AVG(nilai_temperature) as avg_temperature, AVG(nilai_humidity) as avg_humidity')->groupBy('tanggal')->orderBy('tanggal')->get();
        if ($data->isNotEmpty()) {
            return response()->json([
                'data' => $data,
                "dari_tanggal" => $seminggu_lalu,
                "sampai_tanggal" => $tanggal_sekarang
            ]);
        } else {
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }
    }
    public function chartdaritanggal($tanggal_awal, $tanggal_akhir)
    {
        // Mengatur tanggal default
        $tanggal_sekarang = Carbon::now();
        $tanggal_awal = Carbon::parse($tanggal_awal)->format('Y-m-d');
        $tanggal_akhir = Carbon::parse($tanggal_akhir)->addDay()->format('Y-m-d');  // Menambahkan 1 hari pada tanggal akhir

        // Cek jika tanggal_awal lebih besar dari tanggal_akhir, jika ya tukar nilai keduanya
        if (Carbon::parse($tanggal_awal)->greaterThan($tanggal_akhir)) {
            return response()->json([
                'message' => 'Tanggal awal tidak boleh lebih besar dari tanggal akhir',
            ], 400);
        }

        // Query untuk mendapatkan data yang difilter berdasarkan tanggal
        $data = Monicontrolling::whereBetween('created_at', [$tanggal_awal, $tanggal_akhir])
            ->selectRaw('DATE(created_at) as tanggal, AVG(nilai_temperature) as avg_temperature, AVG(nilai_humidity) as avg_humidity')
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('tanggal')
            ->get();

        // Mengecek apakah data ditemukan
        if ($data->isNotEmpty()) {
            return response()->json([
                'data' => $data,
                "dari_tanggal" => $tanggal_awal,
                "sampai_tanggal" => $tanggal_akhir
            ]);
        } else {
            return response()->json([
                'message' => 'Data not found',
                "dari_tanggal" => $tanggal_awal,
                "sampai_tanggal" => $tanggal_akhir,
                'data' => $data
            ], 404);
        }
    }



    public function aturpompa()
    {
        // Ambil status dari alat pertama sebagai referensi (misalnya alat dengan ID terkecil)
        $firstAlat = Alat::where('id', 3)->first();

        if (!$firstAlat) {
            return response()->json(['error' => 'Tidak ada alat yang ditemukan'], 404);
        }

        // Toggle status: jika 1 jadi 0, jika 0 jadi 1
        $status = Alat::where('id', 3)->first();
        $setting = Otomatis::first();
        if (($status->status == 1) && ($setting->status == 1)) {
            $setting->status = 0;
            $setting->save();
            $status->status = 0;
            $message = 'Pompa dimatikan';
            $status->save();
        } elseif (($status->status == 0) && ($setting->status == 1)) {
            $setting->status = 0;
            $setting->save();
            $status->status = 1;
            $message = 'Pompa dihidupkan';
            $status->save();
        } elseif (($status->status == 1) && ($setting->status == 0)) {
            $setting->status = 1;
            $setting->save();
            $status->status = 0;
            $message = 'Pompa dimatikan';
            $status->save();
        } elseif (($status->status == 0) && ($setting->status == 0)) {
            $setting->status = 1;
            $setting->save();
            $status->status = 1;
            $message = 'Pompa diaktifkan';
            $status->save();
        }
        // Pesan respon berdasarkan status terbaru
        $newStatus = $status->status;

        return response()->json([
            'message' => $message,
            'pompa_status' => $newStatus
        ]);
    }


    public function diagnosa(Request $request, $id)
    {
        // Validasi file upload
        $request->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg',
        ]);

        // Periksa apakah file ada
        if (!$request->hasFile('image')) {
            return response()->json([
                'success' => false,
                'message' => 'File tidak ditemukan dalam request',
            ], 400);
        }

        $file = $request->file('image');

        // Periksa apakah file valid
        if (!$file->isValid()) {
            return response()->json([
                'success' => false,
                'message' => 'File tidak valid atau gagal diupload',
            ], 400);
        }

        // Kirim file ke API FastAPI
        try {
            $response = Http::attach(
                'file',
                file_get_contents($file->getPathname()),
                $file->getClientOriginalName()
            )->post('http://192.168.1.16:8585/predict/');

            // Periksa respons dari FastAPI
            if ($response->successful()) {
                $diagnosa = new Diagnosapenyakitdaun();
                $fileName = time() . '.' . $file->getClientOriginalExtension();

                // Upload file
                $file->move(public_path() . '/diagnosa', $fileName);

                $diagnosa->id_user = $id;
                $diagnosa->file = $fileName;
                $data = $response->json();

                // Ambil nilai predicted_class dan confidence
                $predictedClass = $data['predicted_class'];
                $confidence = $data['confidence'];
                $diagnosa->diagnosa = $predictedClass;
                $diagnosa->keakuratan = $confidence;

                // Generate deskripsi menggunakan Gemini API
                $deskripsi = $this->generateDeskripsiWithGemini($predictedClass);
                $diagnosa->deskripsi = $deskripsi;

                $diagnosa->save();

                return response()->json([
                    'success' => true,
                    'diagnosa' => [
                        'predicted_class' => $predictedClass,
                        'confidence' => $confidence,
                        'deskripsi' => $deskripsi
                    ],
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses gambar di FastAPI',
                'error' => $response->body(),
            ], $response->status());
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi API',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    private function generateDeskripsiWithGemini($predictedClass)
    {
        try {
            // Gunakan Guzzle atau Http facade untuk request
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=AIzaSyAu0Bk-gDla6ua4iLtDIywy0io7UJis_1U', [
                'contents' => [
                    'parts' => [
                        'text' => $this->generatePrompt($predictedClass)
                    ]
                ],
                'generationConfig' => [
                    'maxOutputTokens' => 500,
                    'temperature' => 0.7,
                    'topP' => 1.0,
                    'topK' => 40
                ],
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                $generatedText = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'Deskripsi tidak tersedia';

                return $generatedText;
            } else {
                Log::error('Gemini API Error: ' . $response->body());
                return "Informasi detail penyakit tidak dapat dihasilkan.";
            }
        } catch (\Exception $e) {
            Log::error('Kesalahan saat menghasilkan deskripsi: ' . $e->getMessage());
            return "Terjadi kesalahan saat menghasilkan deskripsi.";
        }
    }

    private function generatePrompt($predictedClass)
    {
        if ($predictedClass == 'nodisease') {
            return "Jelaskan kriteria daun kopi yang sehat, normal, dan bebas dari penyakit.
            Berikan informasi tentang karakteristik daun kopi yang optimal dan cara mempertahankan kondisi kesehatan tersebut.";
        } else if ($predictedClass == 'NotFound') {
            return "Buat kalimat yang menyatakan bahwa tidak ada penyakit daun kopi yang dibahas untuk hal ini.";
        } else {
            return "Berikan penjelasan mendalam tentang penyakit $predictedClass pada daun kopi.
            Jelaskan secara rinci:
            1. Deskripsi umum penyakit
            2. Gejala yang terlihat
            3. Penyebab utama
            4. Cara pencegahan
            5. Metode penanganan yang efektif
            6. Solusi alternatif dengan obat tertentu yang bisa digunakan

            Gunakan bahasa Indonesia yang jelas dan informatif untuk petani kopi.";
        }
    }

    public function updateFoto(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 422);
        }

        $pengguna = Pengguna::find($id);
        if (!$pengguna) {
            return response()->json(['status' => 'error', 'message' => 'Pengguna tidak ditemukan'], 404);
        }

        if ($request->hasFile('foto')) {
            if ($pengguna->foto && $pengguna->foto != 'avatar.png') {
                $oldFilePath = public_path('foto_profil/' . $pengguna->foto);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            try {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('foto_profil'), $filename);

                // Update foto di database
                $pengguna->foto = $filename;
                $pengguna->save();
            } catch (\Exception $e) {
                return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan saat menyimpan foto.'], 500);
            }
        }

        // Kembalikan respons sukses
        return response()->json(['status' => 'success', 'message' => 'Foto berhasil diperbarui.'], 200);
    }

    public function updateDataPenggunaWithoutPhoto(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'email' => 'nullable|email|unique:users,email,' . $id,
            'no_telfon' => 'required|unique:users,no_telfon,' . $id,
            'nama' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        try {
            // Update tabel users
            $user = User::findOrFail($id);
            $user->email = $request->input('email', $user->email);
            $user->no_telfon = $request->input('no_telfon', $user->no_telfon);
            $user->save();

            // Update tabel penggunas
            $pengguna = Pengguna::where('id_user', $id)->firstOrFail();
            $pengguna->nama = $request->input('nama', $pengguna->nama);
            $pengguna->alamat = $request->input('alamat', $pengguna->alamat);
            $pengguna->deskripsi = $request->input('deskripsi', $pengguna->deskripsi);
            $pengguna->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data pengguna berhasil diperbarui.',
                'user' => $user,
                'pengguna' => $pengguna,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function changePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Konfirmasi password tidak cocok.'
            ], 400);
        }

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Password lama tidak cocok.'
            ], 400);
        }

        $user = User::find($id);
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Password berhasil diubah.'
        ]);
    }

    public function relay()
    {
        $status = Alat::where('id', 3)->first();
        $status = $status->status;

        return response()->json([
            'status' => 'success',
            'nilai' => $status
        ]);
    }
}

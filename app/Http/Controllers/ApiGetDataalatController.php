<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Monicontrolling;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiGetDataalatController extends Controller
{

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
        $firstAlat = Alat::first();

        if (!$firstAlat) {
            return response()->json(['error' => 'Tidak ada alat yang ditemukan'], 404);
        }

        // Toggle status: jika 1 jadi 0, jika 0 jadi 1
        $newStatus = !$firstAlat->status;

        // Update semua alat dengan status yang baru
        Alat::query()->update(['status' => $newStatus]);

        // Pesan respon berdasarkan status terbaru
        $message = $newStatus ? 'Semua pompa berhasil dihidupkan' : 'Semua pompa berhasil dimatikan';

        return response()->json([
            'message' => $message,
            'pompa_status' => $newStatus
        ]);
    }
}

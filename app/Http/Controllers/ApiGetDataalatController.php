<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Monicontrolling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiGetDataalatController extends Controller
{

    public function index(Request $request)
    {
        // Ambil semua alat
        // $alat = Alat::all();

        // Siapkan array untuk menyimpan data monitoring
        // $data = [];
        $dataa = Monicontrolling::with('alat')->where('id_alat', $request->id_alat)->latest()->first();
        // $data[] = [
        //     // "alat" => $dataa->alat->alat,
        //     "temperature" => $dataa->nilai_temperature,
        //     "humidity" => $dataa->nilai_humidity
        // ];

        // Ambil data terbaru untuk setiap alat dengan menggunakan a join query
        // foreach ($alat as $alatItem) {
        //     $latestMonitoring = Monicontrolling::where('id_alat', $alatItem->id)
        //         ->latest()
        //         ->first();

        //     if ($latestMonitoring) {
        //         $data[] = [
        //             'alat' => $alatItem['alat'],
        //             'latest_monitoring' => $latestMonitoring,
        //         ];
        //     }
        // }

        // Kembalikan data sebagai JSON
        return response()->json($dataa);
    }


    public function senddata(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'id_alat' => 'required|string',
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
        ]);

        // Simpan data monitoring
        $monitoring = new Monicontrolling();

        // Menangkap data dari request yang sudah divalidasi
        $monitoring->id_alat = $validatedData['id_alat'];
        $monitoring->nilai_temperature = $validatedData['temperature'];
        $monitoring->nilai_humidity = $validatedData['humidity'];

        try {
            $monitoring->save();
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
}

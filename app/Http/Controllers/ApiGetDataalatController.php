<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Monicontrolling;
use Illuminate\Http\Request;

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
}

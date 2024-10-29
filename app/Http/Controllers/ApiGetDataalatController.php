<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Monicontrolling;
use Illuminate\Http\Request;

class ApiGetDataalatController extends Controller
{

    public function index()
    {
        // Ambil semua alat
        $alat = Alat::all();

        // Siapkan array untuk menyimpan data monitoring
        $data = [];

        // Ambil data terbaru untuk setiap alat dengan menggunakan a join query
        foreach ($alat as $alatItem) {
            $latestMonitoring = Monicontrolling::where('id_alat', $alatItem->id)
                ->latest()
                ->first();

            if ($latestMonitoring) {
                $data[] = [
                    'alat' => $alatItem['alat'],
                    'latest_monitoring' => $latestMonitoring,
                ];
            }
        }

        // Kembalikan data sebagai JSON
        return response()->json($data);
    }

}

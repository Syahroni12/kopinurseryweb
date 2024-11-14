<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Monicontrolling;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $data = [];
        $alat = Alat::where('id', '<', 5)->get();

        foreach ($alat as $key => $value) {
            $nilai_temperature = Monicontrolling::where('id_alat', $value->id)->latest()->first();
            $nilai_humidity = Monicontrolling::where('id_alat', $value->id)->latest()->first();

            $data[] = [

                'id' => $value->id,
                'nama_alat' => $value->nama_alat,
                'nilai_temperature' => $nilai_temperature->nilai_temperature,
                'nilai_humidity' => $nilai_humidity->nilai_humidity
            ];
        }



        return view('page.dashboard.index', compact('data'));
    }

    public function fetchData()
    {
        $data = [];
        $alat = Alat::where('id', '<', 5)->get();

        foreach ($alat as $key => $value) {
            $nilai_temperature = Monicontrolling::where('id_alat', $value->id)->latest()->first();
            $nilai_humidity = Monicontrolling::where('id_alat', $value->id)->latest()->first();

            $data[] = [
                'id' => $value->id,
                'nilai_temperature' => $nilai_temperature->nilai_temperature,
                'nilai_humidity' => $nilai_humidity->nilai_humidity
            ];
        }

        return response()->json($data);
    }

}

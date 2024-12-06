<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Monicontrolling;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    private function getLatestData($id_alat)
    {
        return [
            'Monicontrolling' => Monicontrolling::where('id_alat', $id_alat)->latest()->first(),

        ];
    }
    public function index()
    {

        $data = [];
        $alat = Alat::where('id', '<', 3)->get();

        foreach ($alat as $key => $value) {
            $monicontrolling = $this->getLatestData($value->id);


            $data[] = [

                'id' => $value->id,
                'nama_alat' => $value->nama_alat,
                'nilai_temperature' => $monicontrolling['Monicontrolling'],
                'nilai_humidity' => $monicontrolling['Monicontrolling']
            ];
        }



        return view('page.dashboard.index', compact('data'));
    }

    public function fetchData()
    {
        $data = [];
        $alat = Alat::where('id', '<', 3)->get();

        foreach ($alat as $key => $value) {

            $monicontrolling = $this->getLatestData($value->id);
            $data[] = [
                'id' => $value->id,
                'nilai_temperature' => $monicontrolling['Monicontrolling'],
                'nilai_humidity' => $monicontrolling['Monicontrolling']
            ];
        }

        return response()->json($data);
    }
}

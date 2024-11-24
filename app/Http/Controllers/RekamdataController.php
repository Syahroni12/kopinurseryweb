<?php

namespace App\Http\Controllers;

use App\Exports\HumidityExport;
use App\Exports\TemperatureExport;
use App\Models\Monicontrolling;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class RekamdataController extends Controller
{
    public function index()
    {
        $tgl_akhir = date('Y-m-d');
        $tgl_awal = date('Y-m-d', strtotime('-1 week'));

        $data = Monicontrolling::whereBetween('created_at', [$tgl_awal, $tgl_akhir])
            ->selectRaw('DATE(created_at) as tanggal, AVG(nilai_temperature) as rata_rata_suhu, AVG(nilai_humidity) as rata_rata_kelembaban')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $categories = $data->pluck('tanggal')->toArray(); // Ambil tanggal sebagai kategori
        $suhuData = $data->pluck('rata_rata_suhu')->toArray();
        $kelembabanData = $data->pluck('rata_rata_kelembaban')->toArray();
        return view('page.rekam-data.index', compact('categories', 'suhuData', 'kelembabanData', 'tgl_awal', 'tgl_akhir'));
    }

    public function monitoring($tgl_awal, $tgl_akhir)
    {
        // $data = Monicontrolling::where('id', $id)->first();
        $tgl_awal = Carbon::parse($tgl_awal)->format('Y-m-d');
        $tgl_akhir = Carbon::parse($tgl_akhir)->format('Y-m-d');
        $data = Monicontrolling::whereBetween('created_at', [$tgl_awal, $tgl_akhir])
            ->selectRaw('DATE(created_at) as tanggal, AVG(nilai_temperature) as rata_rata_suhu, AVG(nilai_humidity) as rata_rata_kelembaban')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $categories = $data->pluck('tanggal')->toArray(); // Ambil tanggal sebagai kategori
        $suhuData = $data->pluck('rata_rata_suhu')->toArray();
        $kelembabanData = $data->pluck('rata_rata_kelembaban')->toArray();


        if ($data->isEmpty()) {
            Alert::error('Gagal', 'Data tidak ditemukan');
            return redirect()->back();
        }
        return view('page.rekam-data.by_tanggal', compact('categories', 'suhuData', 'kelembabanData', 'tgl_awal', 'tgl_akhir'));
    }

    public function cetak_temperature($tgl_awal, $tgl_akhir)
    {
        // $data = Monicontrolling::where('id', $id)->first();
        $tgl_awal = Carbon::parse($tgl_awal)->format('Y-m-d');
        $tgl_akhir = Carbon::parse($tgl_akhir)->format('Y-m-d');


        $data = Monicontrolling::whereBetween('created_at', [$tgl_awal, $tgl_akhir])
            ->selectRaw('DATE(created_at) as tanggal, AVG(nilai_temperature) as rata_rata_suhu, AVG(nilai_humidity) as rata_rata_kelembaban')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $categories = $data->pluck( 'tanggal')->toArray(); // Ambil tanggal sebagai kategori
        $suhuData = $data->pluck('rata_rata_suhu')->toArray();
        $kelembabanData = $data->pluck('rata_rata_kelembaban')->toArray();


        if ($data->isEmpty()) {
            Alert::error('Gagal', 'Data tidak ditemukan');
            return redirect()->back();
        }
        return Excel::download(new TemperatureExport($tgl_awal, $tgl_akhir), 'temperature_data' . $tgl_awal . '-' . $tgl_akhir . '.xlsx');
    }

    public function cetak_humidity($tgl_awal, $tgl_akhir)
    {
        // $data = Monicontrolling::where('id', $id)->first();
        $tgl_awal = Carbon::parse($tgl_awal)->format('Y-m-d');
        $tgl_akhir = Carbon::parse($tgl_akhir)->format('Y-m-d');


        $data = Monicontrolling::whereBetween('created_at', [$tgl_awal, $tgl_akhir])
            ->selectRaw('DATE(created_at) as tanggal, AVG(nilai_temperature) as rata_rata_suhu, AVG(nilai_humidity) as rata_rata_kelembaban')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();
        $categories = $data->pluck('tanggal')->toArray(); // Ambil tanggal sebagai kategori
        $suhuData = $data->pluck('rata_rata_suhu')->toArray();
        $kelembabanData = $data->pluck('rata_rata_kelembaban')->toArray();


        if ($data->isEmpty()) {
            Alert::error('Gagal', 'Data tidak ditemukan');
            return redirect()->back();
        }
        return Excel::download(new HumidityExport($tgl_awal, $tgl_akhir), 'humidity_data_' . $tgl_awal . '-' . $tgl_akhir . '.xlsx');

    }
}

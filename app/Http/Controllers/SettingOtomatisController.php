<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Monicontrolling;
use App\Models\Otomatis;
use App\Models\Settingotomatis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SettingOtomatisController extends Controller
{
    public function index()

    {
        $status = Alat::where('id', 3)->first();
        $status = $status->status;
        $otomatis = Settingotomatis::first();
        return view('page.settingotomatis.index', compact('otomatis', 'status'));
    }

    public function otomatis_suhulembab(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "temperature_awal" => "required",
            "temperature_akhir" => "required",
            "humidity_awal" => "required",
            "humidity_akhir" => "required",
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            Alert::error('Error', $messages);
            return redirect()->back()->withInput();
        }

        $tipe = 'suhu';
        $data = [
            'temperature_awal' => $request->input('temperature_awal'),
            'temperature_akhir' => $request->input('temperature_akhir'),
            'humidity_awal' => $request->input('humidity_awal'),
            'humidity_akhir' => $request->input('humidity_akhir'),
            'waktu1_awal' => null,
            'waktu1_akhir' => null,
            'waktu2_awal' => null,
            'waktu2_akhir' => null,
            'tipe' => $tipe
        ];

        // Sesuaikan dengan logika Anda untuk tipe data

        // Update jika ada, atau buat baru jika tidak ada
        $setting = Settingotomatis::first() ?? new Settingotomatis();

        // Update data yang ditemukan atau diisi dengan data baru
        $setting->fill($data);
        $setting->save();
        Alert::success('Success', 'Data berhasil diupdate atau ditambahkan.');
        return redirect()->back()->with('success', 'Data berhasil diupdate atau ditambahkan.');
    }



    public function otomatis_waktu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "waktu1_awal" => "required",
            "waktu1_akhir" => "required",
            "waktu2_awal" => "required",
            "waktu2_akhir" => "required",
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors()->all();
            Alert::error('Error', $messages);
            return redirect()->back()->with('error', $messages);
        }

        $waktu_awal1 = $this->convertTo24HourFormat($request->input('waktu1_awal'));
        $waktu_akhir1 = $this->convertTo24HourFormat($request->input('waktu1_akhir'));
        $waktu_awal2 = $this->convertTo24HourFormat($request->input('waktu2_awal'));
        $waktu_akhir2 = $this->convertTo24HourFormat($request->input('waktu2_akhir'));
        $tipe = 'waktu';
        $data = [
            'temperature_awal' => null,
            'temperature_akhir' => null,
            'humidity_awal' => null,
            'humidity_akhir' => null,
            'waktu1_awal' => $waktu_awal1,
            'waktu1_akhir' => $waktu_akhir1,
            'waktu2_awal' => $waktu_awal2,
            'waktu2_akhir' => $waktu_akhir2,
            'tipe' => $tipe
        ];

        // Sesuaikan dengan logika Anda untuk tipe data
        $setting = Settingotomatis::first() ?? new Settingotomatis();

        // Update data yang ditemukan atau diisi dengan data baru
        $setting->fill($data);
        $setting->save();
        Alert::success('Success', 'Data berhasil diupdate atau ditambahkan.');
        return redirect()->back();
    }
    public function convertTo24HourFormat($time)
    {
        // Pisahkan jam, menit, dan AM/PM
        list($hour, $minute, $ampm) = sscanf($time, "%d:%d %s");

        // Jika waktu di atas 12 (PM), tambahkan 12 jam
        if (strcasecmp($ampm, 'pm') == 0) {
            $hour += 12;
        }

        // Jika waktu adalah 12 AM (midnight), ubah menjadi 00 jam
        if ($hour == 12 && strcasecmp($ampm, 'am') == 0) {
            $hour = 0;
        }

        // Kembalikan waktu dalam format 24 jam
        return sprintf("%02d:%02d", $hour, $minute);
    }


    public function control_state()
    {

        $status = Alat::where('id', 3)->first();
        $setting = Otomatis::first();
        if (($status->status == 1)&&($setting->status == 1)) {
            $setting->status = 0;
            $setting->save();
            $status->status = 0;
            $status->save();
        } elseif (($status->status == 0) && ($setting->status == 1)) {
            $setting->status = 0;
            $setting->save();
            $status->status = 1;
            $status->save();
        }elseif (($status->status == 1) && ($setting->status == 0)) {
            $setting->status = 1;
            $setting->save();
            $status->status = 0;
            $status->save();
        } elseif (($status->status == 0) && ($setting->status == 0)) {
            $setting->status = 1;
            $setting->save();
            $status->status = 1;
            $status->save();
            # code...
        }
        if ($status->status == 1) {
            Alert::success('Success', ' Pompa diaktifkan!');
            return redirect()->back();
        } else {
            Alert::success('Success', ' Pompa dinonaktifkan!');
            return redirect()->back()->with('success', ' Pompa dinonaktifkan!');
            # code...
        }

        // return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }



    public function cek() {}
}

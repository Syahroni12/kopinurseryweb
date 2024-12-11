<?php

namespace App\Console\Commands;

use App\Models\Alat;
use App\Models\Monicontrolling;
use App\Models\Otomatis;
use App\Models\Settingotomatis;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Otomatisasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:otomatisasi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $alat = Alat::where('id', '<', 3)->get();

        $totalHumidity = 0;
        $totalTemperature = 0;
        $count = 0;


        $otomatis = Settingotomatis::first();
        $setting=Otomatis::first();        // dd($otomatis);
        $status = Alat::where('id', 3)->first();
        $currentTime = Carbon::now();
        $sekarang = $currentTime->format('H:i:s');
        // dd($sekarang);
        if ($setting) {
            if ($setting->status == 1) {
                if ($otomatis) {

                    if ($otomatis->tipe == 'suhu') {
                        foreach ($alat as $value) {
                            $latestMonitoring = Monicontrolling::where('id_alat', $value->id_alat)->latest()->first();


                            if ($latestMonitoring) {
                                $totalHumidity += $latestMonitoring->nilai_humidity;
                                $totalTemperature += $latestMonitoring->nilai_temperature;
                                $count++;
                            }
                        }

                        if ($count > 0) {
                            $averageHumidity = $totalHumidity / $count;
                            $averageTemperature = $totalTemperature / $count;


                            // Mengecek kondisi berdasarkan rata-rata
                            if (
                                ($averageTemperature > $otomatis->temperature_awal && $averageTemperature < $otomatis->temperature_akhir) ||
                                ($averageHumidity > $otomatis->humidity_awal && $averageHumidity < $otomatis->humidity_akhir)
                            ) {
                                $status->status = 1;
                                $status->save();

                                // Tambahkan aksi lain di sini jika dibutuhkan, misalnya mengirim notifikasi.
                            } else {

                                $status->status = 0;
                                $status->save();
                            }
                        } else {
                            return [
                                'averageHumidity' => null,
                                'averageTemperature' => null,
                            ];
                        }
                    } else {

                        if (($currentTime->between($otomatis->waktu1_awal, $otomatis->waktu1_akhir)) || ($currentTime->between($otomatis->waktu2_awal, $otomatis->waktu2_akhir))) {

                            $status->status = 1;
                            $status->save();
                        } else {

                            $status->status = 0;
                            $status->save();
                        }
                    }

                    # code...
                }
            }
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Diagnosapenyakitdaun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class PredicController extends Controller
{
    public function cek()
    {
        return view('page.predic.upload');
    }

    public function predict(Request $request)
    {
        // Validasi file upload
        $request->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Periksa apakah file ada
        if (!$request->hasFile('image')) {
            // return response()->json([
            //     'success' => false,
            //     'message' => 'File tidak ditemukan dalam request',
            // ], 400);
            Alert::error('Gagal', 'File tidak ditemukan dalam request');
            return redirect()->back();
        }

        $file = $request->file('image');

        // Debugging untuk path file
        // \Log::info('File uploaded: ' . $file->getClientOriginalName());
        // \Log::info('Temporary path: ' . $file->getPathname());

        // Periksa apakah file valid
        if (!$file->isValid()) {
            Alert::error('Gagal', 'File tidak valid atau gagal diupload');
            return redirect()->back();
        }

        // Kirim file ke API FastAPI

        try {
            $response = Http::attach(
                'file',
                file_get_contents($file->getPathname()), // Gunakan getPathname()
                $file->getClientOriginalName()
            )->post('http://127.0.0.1:8585/predict/');

            // Periksa respons dari FastAPI
            // if ($response->successful()) {
            $diagnosa = new Diagnosapenyakitdaun();
            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension(); //mengambil ekstensi file

            $request->file('image')->move(public_path() . '/diagnosa', $fileName); //mengupload file ke public/produk
            $diagnosa->file = $fileName;
            $data = $response->json(); // Decode respons JSON otomatis

            // Ambil nilai predicted_class dan confidence
            $predictedClass = $data['predicted_class'];
            $confidence = $data['confidence'];
            $diagnosa->diagnosa = $predictedClass;
            $diagnosa->keakuratan = $confidence;

            $deskripsi = $this->generateDeskripsiWithGemini($predictedClass);
            $diagnosa->deskripsi = $deskripsi;
            $diagnosa->id_user = auth()->user()->id;
            $diagnosa->save();
            Alert::success('Berhasil', 'Gambar berhasil diproses');
            return redirect()->route('hasil_cek');

            // }

            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses gambar di FastAPI',
                'error' => $response->body(),
            ], $response->status());
        } catch (\Exception $e) {
            // \Log::error('Error saat menghubungi API FastAPI: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi API',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function predictt(Request $request)
    {
        // Validasi file upload
        $request->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Periksa apakah file ada
        if (!$request->hasFile('image')) {
            return response()->json([
                'success' => false,
                'message' => 'File tidak ditemukan dalam request',
            ], 400);
        }

        $file = $request->file('image');

        // Debugging untuk path file
        // \Log::info('File uploaded: ' . $file->getClientOriginalName());
        // \Log::info('Temporary path: ' . $file->getPathname());

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
                file_get_contents($file->getPathname()), // Gunakan getPathname()
                $file->getClientOriginalName()
            )->post('http://127.0.0.1:8000/predict/');

            // Periksa respons dari FastAPI
            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'data' => $response->json(),
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses gambar di FastAPI',
                'error' => $response->body(),
            ], $response->status());
        } catch (\Exception $e) {
            // \Log::error('Error saat menghubungi API FastAPI: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghubungi API',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    public function hasil_cek()
    {
        $hasil = Diagnosapenyakitdaun::where('id_user', auth()->user()->id)->latest()->first();
        return view('page.predic.hasil_cek', compact('hasil'));
    }




    public  function riwayat_predik()
    {

        $riwayat = Diagnosapenyakitdaun::orderBy('created_at', 'desc')->paginate(20);
        return view('page.predic.riwayat_predik', compact('riwayat'));

        $riwayat = Diagnosapenyakitdaun::where('id_user', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(20);
        return view('page.predic.riwayat_predik', compact('riwayat'));
    }


    public function hapus($id)
    {
        $riwayat_prediksi = Diagnosapenyakitdaun::find($id);
        $file = public_path() . '/diagnosa/' . $riwayat_prediksi->file;
        if (file_exists($file)) {
            unlink($file);
        }
        $riwayat_prediksi->delete();
        Alert::success('Success', 'Data riwayat_prediksi Berhasil Dihapus');

        return redirect()->route('riwayat_predik');
    }


    private function generateDeskripsiWithGemini($predictedClass) {
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

    private function generatePrompt($predictedClass) {
        if($predictedClass == 'nodisease') {
            return "Jelaskan kriteria daun kopi yang sehat, normal, dan bebas dari penyakit.
            Berikan informasi tentang karakteristik daun kopi yang optimal dan cara mempertahankan kondisi kesehatan tersebut.";
        } else if ($predictedClass == 'NotFound') {
            return "Buat kalimat yang menyatakan bahwa tidak ada penyakit daun kopi yang dibahas untuk hal ini.";
        }
        else {
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

}

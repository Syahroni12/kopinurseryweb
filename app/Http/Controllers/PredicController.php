<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
}

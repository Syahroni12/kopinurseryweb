<?php

use App\Http\Controllers\Api\Auth\LupaPasswordController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AuthController as AuthControllerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiGetDataalatController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'gaslogin']);

Route::post('/lupa-password', [AuthController::class, 'verifikasiPhone']);
Route::post('/lupa-password/verifikasi-otp/{no_telfon}', [AuthController::class, 'verifikasiOTP']);
Route::post('/lupa-password/reset-password/{no_telfon}', [AuthController::class, 'resetPassword']);
Route::post('/lupa-password/kirim-ulang-otp/{no_telfon}', [AuthController::class, 'kirimUlangOTP']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/getdataalat/{id}', [ApiGetDataalatController::class, 'index']);
    Route::get('/get-pengguna/{id}', [AuthController::class, 'getPengguna']);
    Route::post('/logout', [AuthControllerController::class, 'logout']);
    Route::post('/check-token', [AuthController::class, 'checkToken']);
    Route::post('/aturpompa', [ApiGetDataalatController::class, 'aturpompa']);
    Route::get('/chart', [ApiGetDataalatController::class, 'chart']);
    Route::get('/chartdaritanggal/{tanggal_awal}/{tanggal_akhir}', [ApiGetDataalatController::class, 'chartdaritanggal']);
    Route::post('/updatefoto/{id}', [ApiGetDataalatController::class, 'updateFoto']);
    Route::post('/update-data-pengguna-without-photo/{id}', [ApiGetDataalatController::class, 'updateDataPenggunaWithoutPhoto']);
    Route::post('/change-password/{id}', [ApiGetDataalatController::class, 'changePassword']);
    Route::get('/data-diagnosa/{params}', [ApiGetDataalatController::class, 'dataDiagnosa']);
    Route::delete('/data-diagnosa/{id}', [ApiGetDataAlatController::class, 'deleteDataDiagnosa']);
    Route::get('/data-diagnosa-detail/{id}', [ApiGetDataAlatController::class, 'dataDiagnosaDetail']);
});
Route::post('/senddata', [ApiGetDataalatController::class, 'senddata']);
Route::post('/diagnosa/{id}', [ApiGetDataalatController::class, 'diagnosa']);
// Route::post('/senddataa', [ApiGetDataalatController::class, 'senddata']);
Route::get('/relay', [ApiGetDataalatController::class, 'relay']);


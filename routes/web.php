<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PredicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekamdataController;
use App\Http\Controllers\SettingOtomatisController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ROUTE LANDING PAGE
Route::get('/', [LandingPageController::class, 'index'])->name('landing-page')->middleware('guest');
Route::get('/about', [LandingPageController::class, 'about'])->name('landing-page-about')->middleware('guest');
Route::get('/service', [LandingPageController::class, 'service'])->name('landing-page-service')->middleware('guest');
Route::get('/contact', [LandingPageController::class, 'contact'])->name('landing-page-contact')->middleware('guest');



Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::get('/forgot-password', [AuthController::class, 'forgotpass'])->name('forgot-password')->middleware('guest');

Route::post('/forgot-passwordact', [AuthController::class, 'forgotpassact'])->name('forgot-passwordact')->middleware('guest');
Route::post('/checkOTP/{no_telfon}', [AuthController::class, 'checkOTP'])->name('checkOTP')->middleware('guest');
Route::get('/otp-password/{no_telfon}', [AuthController::class, 'otppass'])->name('otp-password')->middleware('guest');
Route::get('/reset-password/{no_telfon}', [AuthController::class, 'resetpass'])->name('reset-password')->middleware('guest');

Route::post('/reset-passwordact/{no_telfon}', [AuthController::class, 'resetpassact'])->name('reset-passwordact')->middleware('guest');

Route::get('/kirimulangotp/{no_telfon}', [AuthController::class, 'kirimulangotp'])->name('kirimulangotp')->middleware('guest');
Route::post('/loginact', [AuthController::class, 'login'])->name('loginact')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logoutt'])->name('logout')->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/create-blog', [BlogController::class, 'create'])->name('create-blog');
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
Route::get('/create-karyawan', [KaryawanController::class, 'create'])->name('create-karyawan');
Route::get('/hapus_karyawan/{id}', [KaryawanController::class, 'hapus'])->name('hapus_karyawan');
Route::get('/edit_karyawan/{id}', [KaryawanController::class, 'edit'])->name('edit_karyawan');
Route::put('/update_karyawan/{id}', [KaryawanController::class, 'update'])->name('update_karyawan');
Route::post('/store-karyawan', [KaryawanController::class, 'store'])->name('store-karyawan');
Route::get('/fetch-data', [DashboardController::class, 'fetchData']);


Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/monitoring/{tgl_awal}/{tgl_akhir}', [RekamdataController::class, 'monitoring'])->name('monitoring');
Route::get('/cetak_temperature/{tgl_awal}/{tgl_akhir}', [RekamdataController::class, 'cetak_temperature'])->name('cetak_temperature');
Route::get('/cetak_humidity/{tgl_awal}/{tgl_akhir}', [RekamdataController::class, 'cetak_humidity'])->name('cetak_humidity_');

Route::post('/profileact', [ProfileController::class, 'simpan'])->name('simpanprofile')->middleware('auth');
Route::get('/edit-blog/{id}', [BlogController::class, 'edit'])->name('edit-blog');
Route::get('/detail-blog/{id}', [BlogController::class, 'detail'])->name('detail-blog');
Route::get('/delete_blog/{id}', [BlogController::class, 'delete'])->name('delete_blog');
Route::put('/update-blog/{id}', [BlogController::class, 'update'])->name('updateblog');
Route::post('/tambah_blog', [BlogController::class, 'store'])->name('storeblog')->middleware('auth');
Route::get('/rekam-data', [RekamdataController::class, 'index'])->name('rekam-data');
Route::get('/atur_pompaotomatis', [SettingOtomatisController::class, 'index'])->name('settingotomatis');
Route::post('/otomatis_suhulembab', [SettingOtomatisController::class, 'otomatis_suhulembab'])->name('otomatis_suhulembab');
Route::post('/otomatis_waktu', [SettingOtomatisController::class, 'otomatis_waktu'])->name('otomatis_waktu');
Route::get('/control_state', [SettingOtomatisController::class, 'control_state'])->name('control_state');
Route::get('/cek', [PredicController::class, 'cek'])->name('cek');
Route::post('/predictt', [PredicController::class, 'predict'])->name('predict');
Route::get('/hasil_cek', [PredicController::class, 'hasil_cek'])->name('hasil_cek');
Route::get('/riwayat_predik', [PredicController::class, 'riwayat_predik'])->name('riwayat_predik')->middleware('auth');
Route::get('/hapus_riwayat_predik/{id}', [PredicController::class, 'hapus'])->name('hapus_riwayat_predik')->middleware('auth');

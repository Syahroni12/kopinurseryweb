<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekamdataController;
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

Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
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


Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profileact', [ProfileController::class, 'simpan'])->name('simpanprofile')->middleware('auth');
Route::get('/edit-blog/{id}', [BlogController::class, 'edit'])->name('edit-blog');
Route::get('/detail-blog/{id}', [BlogController::class, 'detail'])->name('detail-blog');
Route::get('/delete_blog/{id}', [BlogController::class, 'delete'])->name('delete_blog');
Route::put('/update-blog/{id}', [BlogController::class, 'update'])->name('updateblog');
Route::post('/tambah_blog', [BlogController::class, 'store'])->name('storeblog')->middleware('auth');
Route::get('/rekam-data', [RekamdataController::class, 'index'])->name('rekam-data');

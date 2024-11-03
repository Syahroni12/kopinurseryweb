<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProfileController;
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
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/create-blog', [BlogController::class, 'create'])->name('create-blog');
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

// Route::get('/dashboard', function () {
//     return view('page.dashboard.index');
// });

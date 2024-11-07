<?php

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
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/getdataalat/{id}', [ApiGetDataalatController::class, 'index']);
    Route::post('/senddata', [ApiGetDataalatController::class, 'senddata']);
    Route::post('/logout', [AuthControllerController::class, 'logout']);
    Route::post('/check-token', [AuthController::class, 'checkToken']);
});
Route::get('/aturpompa', [ApiGetDataalatController::class, 'aturpompa']);

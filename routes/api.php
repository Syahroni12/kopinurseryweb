<?php

use App\Http\Controllers\Api\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getdataalat/{id}', [ApiGetDataalatController::class, 'index']);
Route::post('/senddata', [ApiGetDataalatController::class, 'senddata']);
Route::get('/logout', [ApiGetDataalatController::class, 'logout']);

Route::post('/login', [AuthController::class, 'gaslogin']);



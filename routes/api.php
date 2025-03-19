<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\HospitalController as Hospital;
use App\Http\Controllers\Api\V1\LoginController as Login;
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


Route::post('/login',                      [Login::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/hospital',      Hospital::class);
});

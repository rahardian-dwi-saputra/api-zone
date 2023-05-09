<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ZoneController;
use App\Http\Controllers\API\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('getprovinsi', [ZoneController::class, 'daftar_provinsi']);
    Route::get('getkota', [ZoneController::class, 'daftar_kota']);
    Route::get('getkecamatan', [ZoneController::class, 'daftar_kecamatan']);
    Route::resource('customers', CustomerController::class)->except(['create', 'edit']);
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\MasterProvinsiController;
use App\Http\Controllers\Backend\MasterKotaController;
use App\Http\Controllers\Backend\MasterKecamatanController;
use App\Http\Controllers\Backend\MasterCustomerController;
use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\PasswordController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\RegisterController;
use App\Http\Controllers\Backend\ForgotPasswordController;
use App\Http\Controllers\Frontend\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/register',  [RegisterController::class, 'index']);
Route::post('/register',  [RegisterController::class, 'register']);

Route::controller(ForgotPasswordController::class)->group(function(){ 
	Route::get('/forgot-password', 'index');
	Route::post('/forgot-password', 'submitForgetPasswordForm');
	Route::get('/reset-password/{token}', 'reset_password_form')->name('reset.password');
	Route::post('/reset-password', 'reset_password');
});

Route::middleware('auth')->group(function(){ 
	Route::get('/dashboard', [DashboardController::class, 'index']);
	
	Route::middleware('can:isAdmin')->group(function(){
		Route::resources([
			'dataprovinsi' => MasterProvinsiController::class,
			'datakota' => MasterKotaController::class,
			'datakecamatan' => MasterKecamatanController::class,
			'user' => UserController::class
		]);
		Route::resource('message', MessageController::class)->except(['index', 'show']);
	});
	Route::resource('message', MessageController::class)->only('index');
	Route::resource('datacustomer', MasterCustomerController::class);
	
	Route::get('getprovinsi',  [MasterKecamatanController::class, 'get_provinsi']);
	Route::get('getkota/{id}', [MasterKecamatanController::class, 'get_kota']);
	Route::get('getkecamatan/{id}', [MasterKecamatanController::class, 'get_kecamatan']);
	Route::get('profil',  [ProfileController::class, 'lihat_profile']);
	Route::get('editprofil',  [ProfileController::class, 'edit_profile']);
	Route::put('profil', [ProfileController::class, 'update_profile']);
	Route::get('gantisandi',  [PasswordController::class, 'edit']);
	Route::put('gantisandi',  [PasswordController::class, 'update']);
	Route::post('/logout', [LoginController::class, 'logout']);
});
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
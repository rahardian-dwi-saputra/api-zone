<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Customer;

class DashboardController extends Controller{
    
    public function index(){
    	return view('backend.dashboard', [
    		'total_provinsi' => Provinsi::count(),
    		'total_kota' => Kota::count(),
    		'total_kecamatan' => Kecamatan::count(),
    		'total_customer' => Customer::count()
    	]); 
    }
}
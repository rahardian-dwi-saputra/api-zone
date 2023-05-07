<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
    	return view('backend.register'); 
    }
    public function register(Request $request){
    	$validated = $request->validate([
        	'name' => 'required|max:255',
        	'email' => 'required|email|unique:users,email|max:255',
        	'username' => 'required|unique:users,username|max:20|alpha_dash',
        	'password' => 'required|min:5|confirmed',
    	]);

    	$validated['password'] = Hash::make($request->password);

    	User::create($validated);
        return redirect('/login')->with('success','Registerasi berhasil, silahkan login');
    }
}

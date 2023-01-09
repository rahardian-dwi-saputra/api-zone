<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller{
    
    public function login(Request $request){
    	$loginData = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt($loginData)) {
            $token =  auth()->user()->createToken('authToken')->accessToken;
            return response()->json(['success' => true, 'token' => $token], 200); 
        }else{
        	return response()->json(['success' => false, 'error' => 'Unauthorised'], 401);
        }
    }
}

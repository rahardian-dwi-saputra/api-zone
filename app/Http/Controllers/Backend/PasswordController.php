<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePasswordReset;

class PasswordController extends Controller{
    public function edit(){
    	return view('backend.profile.gantisandi');
    }
    public function update(UpdatePasswordReset $request){
    	$request->user()->update([
        	'password' => Hash::make($request->get('new_password'))
    	]);
    	return redirect('/gantisandi')->with('success','Password berhasil diubah');
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class ProfileController extends Controller{
    
    public function lihat_profile(){
    	return view('backend.profile.show');
    }
    public function edit_profile(){
    	return view('backend.profile.edit');
    }
    public function update_profile(UserRequest $request){
    	$request->user()->update($request->all());
    	return redirect('/profil')->with('success','Data Profil Berhasil Diperbarui');
    }
}

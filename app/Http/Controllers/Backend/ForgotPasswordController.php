<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForgotPasswordController extends Controller{
    
    public function index(){
    	return view('backend.forgot_password.index'); 
    }
    public function submitForgetPasswordForm(Request $request){
    	$request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
        ]);

        Mail::send('backend.forgot_password.email', ['token' => $token], function($message) use($request){
            	$message->to($request->email);
              	$message->subject('Reset Password');
        });

        return back()->with('message', 'Link Reset Password sudah dikirim ke email anda');
    }
    public function reset_password_form($token){
        return view('backend.forgot_password.reset_password', ['token' => $token]);
    }
    public function reset_password(Request $request){
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')->where([
            'email' => $request->email, 
            'token' => $request->token
        ])->first();

        if(!$updatePassword){
            return back()->with('message','Invalid token!');
        }

        $user = User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);
 
        DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
        return redirect('/login')->with('success', 'Sandi anda berhasil diperbarui');
    }
}

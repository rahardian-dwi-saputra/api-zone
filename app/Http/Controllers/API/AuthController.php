<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller{
    
    /**
     * @OA\Post(
     *   path="/api/login",
     *   tags={"Login"},
     *   summary="User Login",
     *   operationId="Login",
     *   description="Generate API Token",
     *
     *   @OA\Parameter(
     *      name="username",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *           type="string"
     *      )
     *   ),
     *   @OA\Parameter(
     *      name="password",
     *      in="query",
     *      required=true,
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *       description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
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

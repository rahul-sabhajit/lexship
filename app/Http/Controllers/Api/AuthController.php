<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $validateData = $request->validate([
           'name' => 'required|max:55',
           'email' => 'email|required|unique:users',
           'password' => 'required|confirmed',
        ]);
        $validateData['password'] = bcrypt($request->password);
        $user = User::create($validateData);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['code' => 200, 'message' => "success",  'user' => $user, 'access_Token' =>$accessToken]);

    }

    public function login(Request $request){
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);
        if(!auth()->attempt($loginData)){
            return response(['message' => 'Invalid credentials']);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['code' => 200, 'message' => "success", 'user' => auth()->user(), 'access_Token' => $accessToken]);

    }
}

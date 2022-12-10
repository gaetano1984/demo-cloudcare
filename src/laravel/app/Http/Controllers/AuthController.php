<?php

namespace App\Http\Controllers;

// use App\Models\News\NewsUser;
// use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
// use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Exceptions\UserNotFoundException;
use App\Models\UserToken;

class AuthController extends Controller
{
	public function getToken(LoginRequest $request){
		$user = User::where(['email' => $request->get('email')])->get();
		if($user->count()==0){
			throw new UserNotFoundException('user not found');
		}
		$user = $user->first();
		if(!Hash::check($request->get('password'), $user->password)){
			throw new UserNotFoundException('user not found');
		}
		else{
			$token = hash('sha256', \Str::random(60));
			$ut = new UserToken();
			$ut->token = $token;
			$ut->email = $request->get('email');
			$ut->save();
			return response()->json(['token' => $token], 200);
		}
	}
}

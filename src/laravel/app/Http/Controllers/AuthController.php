<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Exceptions\UserNotFoundException;
use App\Services\UserService;
use App\Services\UserTokenService;

class AuthController extends Controller
{
	public function getToken(LoginRequest $request, UserService $userService, UserTokenService $userTokenService){
		$user = $userService->findByEmail($request->get('email'));
		if($user->count()===0){
			throw new UserNotFoundException('user not found');
		}
		$user = $user->first();
		$checkPass = $userService->checkPassword($user, $request->get('password'));
		if(!$checkPass){
			throw new UserNotFoundException('user not found');
		}
		else{
			$token = hash('sha256', \Str::random(60));
			$userTokenService->saveToken($request->get('email'), $token);
			return response()->json(['token' => $token], 200);
		}
	}
}

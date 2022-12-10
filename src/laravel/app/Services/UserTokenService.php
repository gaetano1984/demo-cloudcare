<?php

namespace App\Services;

use App\Models\UserToken;

class UserTokenService{
    public function __construct(){

    }
    public function saveToken($email, $token){
        $ut = new UserToken();
        $ut->token = $token;
        $ut->email = $email;
        $ut->save();
    }
    public function search($token){
        $token = UserToken::where('token', $token);
        return $token;
    }
}


?>
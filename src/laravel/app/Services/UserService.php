<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService{
    public function __construct(){

    }
    public function findByEmail($email){
        $user = User::where(['email' => $email])->get();
        return $user;
    }
    public function checkPassword($user, $password){
        $check = Hash::check($password, $user->password);
        return $check;
    }
}


?>
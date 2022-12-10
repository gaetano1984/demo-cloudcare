<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DefaultUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $check = User::where('email', 'root')->get();
        if($check->count()==0){
            $u = new User();
            $u->name = 'root';
	        // $u->surname = 'root';
	        $u->email = 'root';
	        $u->password = \Hash::make('password');
	        $u->save();
        }
    }
}

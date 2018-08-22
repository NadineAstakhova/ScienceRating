<?php

namespace App\Models\AdminPanel;

use Illuminate\Database\Eloquent\Model;
use DB;

class CreateMethodistForm extends Model
{
    public function createMethodist($username, $email, $password){
        $insert = DB::table('users')->insert([
            ['username' => $username, 'email' => $email, 'password' => bcrypt($password), 'type' => 3]
        ]);
        if ($insert)
            return true;
        else
            return false;
    }
}

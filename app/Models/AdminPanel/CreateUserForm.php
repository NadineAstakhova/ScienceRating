<?php

namespace App\Models\AdminPanel;

use App\User;
use Illuminate\Database\Eloquent\Model;
use DB;

class CreateUserForm extends Model
{
    public function createMethodist($username, $email, $password){
       $user = new User();
       return $user->createMethodist($username, $email, $password);
    }
}

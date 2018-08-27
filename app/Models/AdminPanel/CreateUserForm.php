<?php

namespace App\Models\AdminPanel;

use App\Models\UsersModels\Professor;
use App\User;
use Illuminate\Database\Eloquent\Model;
use DB;

class CreateUserForm extends Model
{
    public function createMethodist($username, $email, $password){
       $user = new User();
       return $user->createUser($username, $email, $password, User::METHODIST);
    }

    public function createProfessor($username, $email, $password, $name, $surname, $patronymic){
        $user = new Professor();
        return $user->createProfessor($username, $email, $password, $name, $surname, $patronymic);
    }
}

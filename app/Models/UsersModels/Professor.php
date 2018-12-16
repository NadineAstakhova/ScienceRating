<?php

namespace App\Models\UsersModels;

use App\Models\BaseModel;
use App\User;
use Illuminate\Database\Eloquent\Model;
use DB;

class Professor extends BaseModel
{
    protected $primaryKey = 'id';
    protected $table = 'professor';
    protected $fillable = array('name', 'surname', 'patronymic','name_ukr', 'surname_ukr',
        'patronymic_ukr', 'name_en', 'surname_en',  'status', 'type_user');

    public static function findIdentity($id){
        $professor = DB::table('professor')
            ->join('users', 'users.idUsers', '=', 'professor.type_user')
            ->where('professor.type_user', '=', $id)
            ->first();
        return $professor;
    }

    public function updateProfInfo($id, $name, $surname, $patronymic, $name_ukr, $surname_ukr, $patronymic_ukr, $name_en, $surname_en){
        $update = DB::table('professor')
            ->where('id', $id)
            ->update(['name' => $name, 'surname' => $surname, 'patronymic' => $patronymic,
                      'name_ukr' => $name_ukr, 'surname_ukr' => $surname_ukr, 'patronymic_ukr' => $patronymic_ukr,
                      'name_en' => $name_en, 'surname_en' => $surname_en]);
        if($update)
            return true;
        else
            return false;
    }

    public function updateUserInfo($id, $email){
        $update = DB::table('users')
            ->where('idUsers', $id)
            ->update(['email' => $email]);
        if($update)
            return true;
        else
            return false;
    }

    public function createProfessor($username, $email, $password, $name, $surname, $patronymic){
        $user = new User();
        if ($user->createUser($username, $email, $password, User::PROFESSOR)){
            $last_id = DB::getPdo()->lastInsertId();
            $insert = DB::table('professor')->insert([
                ['name' => $name, 'surname' => $surname, 'patronymic' =>$patronymic, 'type_user' => $last_id]
            ]);
            return $insert;
        }
        else
            return false;
    }

    public static function getCountOfSubject(){
        $subjects = DB::table('subject')->get();
        return count($subjects);
    }

}

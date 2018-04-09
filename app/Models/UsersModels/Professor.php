<?php

namespace App\Models\UsersModels;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use DB;

class Professor extends BaseModel
{
    protected $primaryKey = 'id';
    protected $table = 'professor';
    protected $fillable = array('name', 'surname', 'patronymic', 'status', 'type_user');

    public static function findIdentity($id){
        $professor = DB::table('professor')
            ->join('users', 'users.idUsers', '=', 'professor.type_user')
            ->where('professor.type_user', '=', $id)
            ->first();
        return $professor;
    }

    public function updateProfInfo($id, $name, $surname, $patronymic){
        $update = DB::table('professor')
            ->where('id', $id)
            ->update(['name' => $name, 'surname' => $surname, 'patronymic' => $patronymic]);
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

}

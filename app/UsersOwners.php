<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class UsersOwners extends BaseModel
{
    protected $primaryKey = 'idUsers';
    protected $table = 'users';
    protected $fillable = array('username', 'email', 'type', 'name', 'patronymic', 'surname');

    const ARRAY_ROLES = array('участник' => 'участник',
        'призёр'=> 'призёр',
        'победитель' => 'победитель',
        'тренер' =>  'тренер',
        '30%' => '30%',
        '40%' => '40%',
        '50%' => '50%',
        '60%' => '60%',
        '70%' => '70%');

    public static function getAllUsersForTable(){
        $arrUsersStudents = DB::table('student')
            //->join('group', 'group.idgroup', '=', 'student.FK_Group')
            ->join('users', 'users.idUsers', '=', 'student.type_user')
            ->join('access', 'access.idAccess',  '=', 'users.type')
            ->get();
        $arrUsersProf = DB::table('professor')
            ->join('users', 'users.idUsers', '=', 'professor.type_user')
            ->join('access', 'access.idAccess',  '=', 'users.type')
            ->get();

        return $arrUsersStudents->merge($arrUsersProf);
    }

    public function setOwnersForResult($idRes, $arrUsers, $arrRoles){
        $insert = false;
        foreach ($arrUsers as $key=>$value){
            $insert = DB::table('scient_res_owner')->insert([
                ['fkRes' => $idRes, 'fkOwner' => $arrUsers[$key], 'role' => $arrRoles[$key]]
            ]);
        }
        if ($insert)
            return true;
        else
            return false;
    }




}

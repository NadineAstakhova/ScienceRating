<?php

namespace App\Models;

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

    public static function getAllUsersForTable($owners = null){
        $arrUsersStudents = DB::table('student')
            //->join('group', 'group.idgroup', '=', 'student.FK_Group')
            ->join('users', 'users.idUsers', '=', 'student.type_user')
            ->join('access', 'access.idAccess',  '=', 'users.type')
            ->get();
        $arrUsersProf = DB::table('professor')
            ->join('users', 'users.idUsers', '=', 'professor.type_user')
            ->join('access', 'access.idAccess',  '=', 'users.type')
            ->get();
        $arrUser =  $arrUsersStudents->merge($arrUsersProf);
        if (!is_null($owners)){

            foreach($arrUser as $user) {
                if (in_array($user->idUsers, $owners))
                    $user->check = '0';
                else {
                    $user->check = '1';
                }
            }
           return  $arrUser->sortBy('check');
        }

        return $arrUser;
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

    public static function getUserById($id){
        $access = self::getAccess($id);
        $user ='';
        if($access == '1')
            $user = DB::table('professor')
                ->where('type_user', '=', $id)
                ->first();
        if($access == '2')
            $user = DB::table('student')
                ->where('type_user', '=', $id)
                ->first();
        if(!is_null($user->patronymic))
            return $user->surname.' '.$user->name.' '.$user->patronymic;
        else
            return $user->surname.' '.$user->name;
    }

    private static function getAccess($idUser){
        $access = DB::table('users')
            ->where('idUsers', '=', $idUser)
            ->first();
        return $access->type;

    }

    public static function getCountOfUserRes($idUser, $idType){
        $sum = DB::table('scient_res_owner')
            ->join('scientific_result', 'scientific_result.idRes', '=', 'scient_res_owner.fkRes')
            ->where([['scientific_result.fkType', '=', $idType], ['scient_res_owner.fkOwner', '=', $idUser]])
            ->count('scient_res_owner.idOwner');
        return $sum;
    }



    public static function getGroups($year){
        $groups = DB::table('group')
            ->where('year', '=', $year)
            ->get();
        return $groups;
    }

    public static function getStudentsInGroup($idGroup){
        $arrUsersStudents = DB::table('student')
            ->join('users', 'users.idUsers', '=', 'student.type_user')
            ->where('student.FK_Group', '=', $idGroup)
            ->get();
        return $arrUsersStudents;
    }

    public static function getProf(){
        $arrUsersProf = DB::table('professor')
            ->join('users', 'users.idUsers', '=', 'professor.type_user')
            ->join('access', 'access.idAccess',  '=', 'users.type')
            ->get();
        return $arrUsersProf;
    }

    public static function userResults($idUser){
        $arrResults = DB::table('scient_res_owner')
            ->join('scientific_result', 'scient_res_owner.fkRes', '=', 'scientific_result.idRes')
            ->join('type_of_scient_res', 'scientific_result.fkType',  '=', 'type_of_scient_res.idType_certificates')
            ->where('scient_res_owner.fkOwner', '=', $idUser)
            ->orderBy('scientific_result.date', 'ASC')
            ->orderBy('type_of_scient_res.type', 'ASC')
            ->get();
        return $arrResults;
    }


    public static function countOfArticles($arrUsers){
        foreach($arrUsers as $user) {
            $user->countA = self::countOfArticlesByID($user->idUsers);
        }
        return $arrUsers->sortByDesc('countA');
    }

    public static function countOfArticlesByID($idUser){
        $count = DB::table('article_in_res')
            ->join('scientific_result', 'article_in_res.fkRes', '=', 'scientific_result.idRes')
            ->join('scient_res_owner', 'scient_res_owner.fkRes',  '=', 'scientific_result.idRes')
            ->where('scient_res_owner.fkOwner', '=', $idUser)
            ->count();
        return $count;
    }

    public static function articlesByID($idUser){
        $articles =  DB::table('article_in_res')
            ->select('article_in_res.title as atitle', 'article_in_res.publishing', 'article_in_res.pages', 'scientific_result.date')
            ->join('scientific_result', 'article_in_res.fkRes', '=', 'scientific_result.idRes')
            ->join('scient_res_owner', 'scient_res_owner.fkRes',  '=', 'scientific_result.idRes')
            ->where('scient_res_owner.fkOwner', '=', $idUser)
            ->get();
        return $articles;
    }











}

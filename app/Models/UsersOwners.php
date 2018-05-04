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

    public function setAuthorsForPublication($idRes, $arrUsers, $arrRoles ){
        $insert = false;
        foreach ($arrUsers as $key=>$value){
            $insert = DB::table('authors_of_publication')->insert([
                ['fk_pub' => $idRes, 'fk_user' => $arrUsers[$key], 'percent_of_writing' => $arrRoles[$key], 'status' => 'confirmed']
            ]);
        }
        if ($insert)
            return true;
        else
            return false;
    }

    public function setMembersOfEvent($idRes, $arrUsers, $arrRoles, $arrResults){
        $insert = false;
        foreach ($arrUsers as $key=>$value){
            $insert = DB::table('members_of_event')->insert([
                ['fk_member' => $arrRoles[$key], 'fk_event' => $idRes, 'fk_res' => $arrRoles[$key],
                    'fk_role' => $arrResults[$key], 'file' => 'dd',  'status' => 'confirmed']
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

    public static function getCountOfUserEvent($idUser, $idType){
        $sum = DB::table('members_of_event')
            ->join('scient_event', 'scient_event.idScientEvent', '=', 'members_of_event.fk_event')
            ->where([['scient_event.fk_type_res', '=', $idType], ['members_of_event.fk_member', '=', $idUser],
                    ['members_of_event.status', '=', 'confirmed']])
            ->count('members_of_event.idMember');
        return $sum;
    }
    public static function getCountOfUserPublication($idUser, $idType){
        $sum = DB::table('authors_of_publication')
            ->join('scient_publication', 'scient_publication.idPublication', '=', 'authors_of_publication.fk_pub')
            ->where([['scient_publication.fk_pub_type', '=', $idType], ['authors_of_publication.fk_user', '=', $idUser],
                    ['authors_of_publication.status', '=', 'confirmed']])
            ->count('authors_of_publication.idPubAuthor');
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




    public static function countOfArticles($arrUsers){
        foreach($arrUsers as $user) {
            $user->countA = self::countOfArticlesByID($user->idUsers);
        }
        return $arrUsers->sortByDesc('countA');
    }

    public static function countOfArticlesByID($idUser){
        $count = DB::table('authors_of_publication')
          //  ->join('scientific_result', 'article_in_res.fkRes', '=', 'scientific_result.idRes')
         //   ->join('scient_res_owner', 'scient_res_owner.fkRes',  '=', 'scientific_result.idRes')
            ->where([['authors_of_publication.fk_user', '=', $idUser], ['authors_of_publication.status', '=', 'confirmed']])
            ->count();
        return $count;
    }

    public static function articlesByID($idUser, $status = null){
        if (!is_null($status)){
            $articles =  DB::table('authors_of_publication')
                // ->select('article_in_res.title as atitle', 'article_in_res.publishing', 'article_in_res.pages', 'scientific_result.date')
                ->join('scient_publication', 'authors_of_publication.fk_pub', '=', 'scient_publication.idPublication')
                ->join('type_of_publication', 'scient_publication.fk_pub_type',  '=', 'type_of_publication.idTypePub')
                ->where([['authors_of_publication.fk_user', '=', $idUser], ['authors_of_publication.status', '=', $status]])
                ->orderBy('scient_publication.date', 'DESC')
                ->get();
            return $articles;
        }
        else{
            $articles =  DB::table('authors_of_publication')
                // ->select('article_in_res.title as atitle', 'article_in_res.publishing', 'article_in_res.pages', 'scientific_result.date')
                ->join('scient_publication', 'authors_of_publication.fk_pub', '=', 'scient_publication.idPublication')
                ->join('type_of_publication', 'scient_publication.fk_pub_type',  '=', 'type_of_publication.idTypePub')
                ->where('authors_of_publication.fk_user', '=', $idUser)
                ->orderBy('scient_publication.date', 'DESC')
                ->get();
            return $articles;
        }
    }

    public static function getUserEvents($idUser){
        $arrArticles = DB::table('members_of_event')
            ->join('scient_event', 'members_of_event.fk_event', '=', 'scient_event.idScientEvent')
            ->join('type_of_result', 'members_of_event.fk_res', '=', 'type_of_result.idTypeRes')
            ->join('type_of_role', 'members_of_event.fk_role', '=', 'type_of_role.idTypeRole')
            ->join('type_of_scient_event', 'scient_event.fk_type_res',  '=', 'type_of_scient_event.idTypeEvents')
            ->where('members_of_event.fk_member', '=', $idUser)
            ->orderBy('scient_event.date', 'DESC')
            ->get();
        return $arrArticles;
    }

    public static function getUserResults($idUser){
        $arrEvents = self::getUserEvents($idUser);
        $arrArticles = self::articlesByID($idUser);
        $arrResults =  $arrEvents->merge($arrArticles);
        return $arrResults;
    }










}

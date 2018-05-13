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

    public function setAuthorsForPublication($idRes, $arrUsers, $arrRoles, $status ){
        $insert = false;
        if (is_array($arrUsers) || is_array($arrRoles)){
            foreach ($arrUsers as $key=>$value){
                $insert = DB::table('authors_of_publication')->insert([
                    ['fk_pub' => $idRes, 'fk_user' => $arrUsers[$key], 'percent_of_writing' => $arrRoles[$key], 'status' => $status]
                ]);
            }
        }
        else
            $insert = DB::table('authors_of_publication')->insert([
                ['fk_pub' => $idRes, 'fk_user' => $arrUsers, 'percent_of_writing' => $arrRoles, 'status' => $status]
            ]);

        if ($insert)
            return true;
        else
            return false;
    }

    public function editAuthorsForPublication($idRes, $arrUsers, $arrRoles ){
        $insert = false;
        $oldRow = $this->allRowAtTablePublication($idRes);

        foreach ($oldRow as $old){
            if(!in_array($old->fk_user, $arrUsers)){
                $this->deleteRowFromPublication($old->idPubAuthor);
            }
            else
                continue;
        }

        foreach ($arrUsers as $key=>$value){
            $existRow = $this->existsPubRow($arrUsers[$key], $idRes);
            if($existRow != false)
                $insert = DB::table('authors_of_publication')
                    ->where('idPubAuthor', $existRow)
                    ->update( ['percent_of_writing' => $arrRoles[$key]]);
            else
                $insert = DB::table('authors_of_publication')->insert([
                    ['fk_pub' => $idRes, 'fk_user' => $arrUsers[$key], 'percent_of_writing' => $arrRoles[$key], 'status' => 'confirmed']
                ]);
        }
        if ($insert)
            return true;
        else
            return false;
    }

    public function setMembersOfEvent($idRes, $arrUsers, $arrRoles, $arrResults, $file, $status){
        $insert = false;
        if (is_array($arrUsers)) {
            foreach ($arrUsers as $key => $value) {
                $insert = DB::table('members_of_event')->insert([
                    ['fk_member' => $arrUsers[$key], 'fk_event' => $idRes, 'fk_res' => $arrResults[$key],
                        'fk_role' => $arrRoles[$key], 'file' => $file[$key], 'status' => $status]
                ]);
            }
        }
        else
            $insert = DB::table('members_of_event')->insert([
                ['fk_member' => $arrUsers, 'fk_event' => $idRes, 'fk_res' => $arrResults,
                    'fk_role' => $arrRoles, 'file' => $file, 'status' => $status]
            ]);
        if ($insert)
            return true;
        else
            return false;
    }

    public function editMembersOfEvent($idRes, $arrUsers, $arrRoles, $arrResults){
        $insert = false;
        $oldRow = $this->allRowAtTable($idRes);

        foreach ($oldRow as $old){
            if(!in_array($old->fk_member, $arrUsers)){
               $this->deleteRow($old->idMember);
            }
            else
                continue;
        }

        foreach ($arrUsers as $key=>$value){
            $existRow = $this->existsRow($arrUsers[$key], $idRes);
            if($existRow != false)
                $insert = DB::table('members_of_event')
                    ->where('idMember', $existRow)
                    ->update( ['fk_res' => $arrResults[$key], 'fk_role' => $arrRoles[$key]]);
            else

                $insert = DB::table('members_of_event')->insert([
                    ['fk_member' => $arrUsers[$key], 'fk_event' => $idRes, 'fk_res' => $arrResults[$key],
                        'fk_role' => $arrRoles[$key], 'file' => 'dd',  'status' => 'confirmed']
                ]);
        }
        if ($insert)
            return true;
        else
            return false;
    }

    public function existsRow($idMember, $idRes){
        $row = DB::table('members_of_event')
            ->where([['fk_member', '=', $idMember], ['fk_event', '=', $idRes]])
            ->first();
        if (count($row) > 0)
            return $row->idMember;
        else
            return false;
    }

    public function deleteRow($id){
        $delete = DB::table('members_of_event')
            ->where('idMember', '=', $id)
            ->delete();
        return $delete;
    }

    public function allRowAtTable($idRes){
        $row = DB::table('members_of_event')
            ->where('fk_event', '=', $idRes)
            ->get();
        if (count($row) > 0)
            return $row;
        else
            return false;
    }

    public function existsPubRow($idMember, $idRes){
        $row = DB::table('authors_of_publication')
            ->where([['fk_user', '=', $idMember], ['fk_pub', '=', $idRes]])
            ->first();
        if (count($row) > 0)
            return $row->idPubAuthor;
        else
            return false;
    }

    public function allRowAtTablePublication($idRes){
        $row = DB::table('authors_of_publication')
            ->where('fk_pub', '=', $idRes)
            ->get();
        if (count($row) > 0)
            return $row;
        else
            return false;
    }

    public function deleteRowFromPublication($id){
        $delete = DB::table('authors_of_publication')
            ->where('idPubAuthor', '=', $id)
            ->delete();
        return $delete;
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
        $arrEvents = DB::table('members_of_event')
            ->join('scient_event', 'members_of_event.fk_event', '=', 'scient_event.idScientEvent')
            ->join('type_of_result', 'members_of_event.fk_res', '=', 'type_of_result.idTypeRes')
            ->join('type_of_role', 'members_of_event.fk_role', '=', 'type_of_role.idTypeRole')
            ->join('type_of_scient_event', 'scient_event.fk_type_res',  '=', 'type_of_scient_event.idTypeEvents')
            ->where('members_of_event.fk_member', '=', $idUser)
            ->orderBy('scient_event.date', 'DESC')
            ->get();
        return $arrEvents;
    }

    public static function getUserResults($idUser){
        $arrEvents = self::getUserEvents($idUser);
        $arrArticles = self::articlesByID($idUser);
        $arrResults =  $arrEvents->merge($arrArticles);
        return $arrResults;
    }










}

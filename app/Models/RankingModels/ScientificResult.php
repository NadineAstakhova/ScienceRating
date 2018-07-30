<?php

namespace App\Models\RankingModels;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use DB;

class ScientificResult extends BaseModel
{
    protected $primaryKey = 'idRes';
    protected $table = 'scient_event';
    protected $fillable = array('title', 'date', 'fkType', 'file');

    const ARRAY_STATUS = array('new' => 'новый',
        'confirmed'=> 'подтверждённый',
        'unconfirmed' => 'не подтверждённый',
        );

    public function insertEvent($title,$date, $fkType){
        $insert = DB::table('scient_event')->insert([
            ['titleEvent' => $title, 'date' => $date, 'fk_type_res' => $fkType]
        ]);
        if ($insert)
            return true;
        else
            return false;
    }

    public function insertPublication($title, $publishing, $pages, $date, $file, $fkType){
        $insert = DB::table('scient_publication')->insert([
            ['title' => $title, 'edition' => $publishing, 'pages' => $pages, 'date' => $date, 'file' => $file, 'fk_pub_type' => $fkType]
        ]);
        if ($insert)
            return true;
        else
            return false;
    }

    public static function getAllNewEvents(){
        $arrNewEvents = DB::table('members_of_event')
            ->select("users.*", "scient_event.*", "type_of_result.*", "type_of_role.*", "type_of_scient_event.*", "members_of_event.*",
                "student.surname AS student_surname", "professor.surname AS professor_surname",
                "student.name AS student_name", "professor.name AS professor_name")
            ->join('users', 'users.idUsers', '=', 'members_of_event.fk_member')
            ->leftjoin('professor', 'professor.type_user', '=', 'users.idUsers')
            ->leftjoin('student', 'student.type_user', '=', 'users.idUsers')
            ->join('scient_event', 'members_of_event.fk_event', '=', 'scient_event.idScientEvent')
            ->join('type_of_result', 'members_of_event.fk_res', '=', 'type_of_result.idTypeRes')
            ->join('type_of_role', 'members_of_event.fk_role', '=', 'type_of_role.idTypeRole')
            ->join('type_of_scient_event', 'scient_event.fk_type_res',  '=', 'type_of_scient_event.idTypeEvents')
            ->where('members_of_event.status', '=', 'new')
            ->orderBy('scient_event.date', 'DESC')
            ->get();
        return $arrNewEvents;
    }

    public static function getAllNewPublications(){
        $arrNewPublications =  DB::table('authors_of_publication')
            ->select("users.*", "type_of_publication.*", "scient_publication.*", "authors_of_publication.*",
                "student.surname AS student_surname", "professor.surname AS professor_surname",
                "student.name AS student_name", "professor.name AS professor_name")
            ->join('users', 'users.idUsers', '=', 'authors_of_publication.fk_user')
            ->leftjoin('professor', 'professor.type_user', '=', 'users.idUsers')
            ->leftjoin('student', 'student.type_user', '=', 'users.idUsers')
            ->join('scient_publication', 'authors_of_publication.fk_pub', '=', 'scient_publication.idPublication')
            ->join('type_of_publication', 'scient_publication.fk_pub_type',  '=', 'type_of_publication.idTypePub')

            ->where('authors_of_publication.status', '=', 'new')
            ->orderBy('scient_publication.date', 'DESC')
            ->get();
        return $arrNewPublications;
    }

    public static function setStatusOfEvents($arrStatusConf, $status){
        $update = DB::table('members_of_event')
            ->whereIn('idMember', $arrStatusConf)
            ->update(['status' => $status]);
        return $update;
    }


    public static function setStatusOfPublications($arrStatusConf, $status){
        $update = DB::table('authors_of_publication')
            ->whereIn('idPubAuthor', $arrStatusConf)
            ->update(['status' => $status]);
        return $update;
    }

    public static function getCountOfAllNewResults(){
        $newPublications = self::getAllNewPublications();
        $newEvents = self::getAllNewEvents();
        return count($newEvents) + count($newPublications);
    }





}

<?php

namespace App\Models\RankingModels;

use Illuminate\Database\Eloquent\Model;
use DB;

class ScientificEvent extends Model
{
    protected $primaryKey = 'idScientEvent';
    protected $table = 'scient_event';
    protected $fillable = array('titleEvent', 'date', 'fk_type_res');

    private $idScientEvent;

    public function __construct($idScientEvent, $attributes = [])
    {
        $this->idScientEvent = $idScientEvent;
        parent::__construct($attributes);
    }

    public function identifyEvent(){
        $event = DB::table('scient_event')
            ->join('type_of_scient_event', 'scient_event.fk_type_res',  '=', 'type_of_scient_event.idTypeEvents')
            ->where('scient_event.idScientEvent', '=',  $this->idScientEvent )
            ->first();
        return $event;
    }

    public function getMembers(){
        $members = DB::table('members_of_event')
            ->select("users.*",  "type_of_result.*", "type_of_role.*", "members_of_event.*",
                "student.surname AS student_surname", "professor.surname AS professor_surname",
                "student.name AS student_name", "professor.name AS professor_name")
            ->join('users', 'users.idUsers', '=', 'members_of_event.fk_member')
            ->leftjoin('professor', 'professor.type_user', '=', 'users.idUsers')
            ->leftjoin('student', 'student.type_user', '=', 'users.idUsers')
            ->join('type_of_result', 'members_of_event.fk_res', '=', 'type_of_result.idTypeRes')
            ->join('type_of_role', 'members_of_event.fk_role', '=', 'type_of_role.idTypeRole')
            ->where('members_of_event.fk_event', '=',  $this->idScientEvent )
            ->get();
        return $members;
    }

    public function editEventInfo($title, $date, $fkType){
        $update = DB::table('scient_event')
            ->where('idScientEvent', $this->idScientEvent)
            ->update( ['titleEvent' => $title, 'date' => $date, 'fk_type_res' => $fkType]);
        return $update;
    }

}

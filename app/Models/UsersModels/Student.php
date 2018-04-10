<?php

namespace App\Models\UsersModels;

use Illuminate\Database\Eloquent\Model;
use DB;

class Student extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'student';
    protected $fillable = array('name', 'surname', 'patronymic','name_ukr', 'surname_ukr',
                                'patronymic_ukr', 'name_en', 'surname_en',  'status', 'type_user', 'FK_Group');

    public static function findIdentity($id){
        $student = DB::table('student')
            ->select('student.*', 'users.*', 'group.name as groupName',  'group.full_name as groupFullName')
            ->join('users', 'users.idUsers', '=', 'student.type_user')
            ->join('group', 'group.idgroup', '=', 'student.FK_Group')
            ->where('student.type_user', '=', $id)
            ->first();
        return $student;
    }

    public function updateStudentInfo($id, $name, $surname, $patronymic, $name_ukr, $surname_ukr, $patronymic_ukr, $name_en, $surname_en){
        $update = DB::table('student')
            ->where('id', $id)
            ->update(['name' => $name, 'surname' => $surname, 'patronymic' => $patronymic,
                'name_ukr' => $name_ukr, 'surname_ukr' => $surname_ukr, 'patronymic_ukr' => $patronymic_ukr,
                'name_en' => $name_en, 'surname_en' => $surname_en]);
        if($update)
            return true;
        else
            return false;
    }
}

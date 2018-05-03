<?php

namespace App\Models\RankingModels;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use DB;

class TypeOfRes extends BaseModel
{

    public static function getAll(){
        $types = DB::table('type_of_scient_res')
            ->get();
        $arr = array();
        foreach ($types as $type) {
            $arr[$type->idType_certificates] = $type->type . ' '. $type->type_of_participation;
        }
        return $arr;
    }

    public static function getPublicationTypes(){
       $types =  DB::table('type_of_publication')->get();
        $arr = array();
        foreach ($types as $type) {
            $arr[$type->idTypePub] = $type->type;
        }
        return $arr;
    }

    public static function getEventTypes(){
        $types =  DB::table('type_of_scient_event')->get();
        $arr = array();
        foreach ($types as $type) {
            $arr[$type->idTypeEvents] = $type->type;
        }
        return $arr;
    }

    public static function getRolesTypes(){
        $types =  DB::table('type_of_role')->get();
        $arr = array();
        foreach ($types as $type) {
            $arr[$type->idTypeRole] = $type->type_of_role;
        }
        return $arr;
    }

    public static function getResultTypes(){
        $types =  DB::table('type_of_result')->get();
        $arr = array();
        foreach ($types as $type) {
            $arr[$type->idTypeRes] = $type->type_of_res;
        }
        return $arr;
    }
}

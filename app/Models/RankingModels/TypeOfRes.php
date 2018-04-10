<?php

namespace App\Models\RankingModels;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use DB;

class TypeOfRes extends BaseModel
{
    protected $primaryKey = 'idType_certificates';
    protected $table = 'type_of_scient_res';
    protected $fillable = array('type', 'type_of_participation');

    public static function getAll(){
        $types = DB::table('type_of_scient_res')
            ->get();
        $arr = array();
        foreach ($types as $type) {
            $arr[$type->idType_certificates] = $type->type . ' '. $type->type_of_participation;
        }
        return $arr;
    }
}

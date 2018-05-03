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

}

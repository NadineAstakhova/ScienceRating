<?php

namespace App\Models\RankingModels;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use DB;

class ScientificResult extends BaseModel
{
    protected $primaryKey = 'idRes';
    protected $table = 'scientific_result';
    protected $fillable = array('title', 'date', 'fkType', 'file');

    public function insertResult($title, $date, $fkType, $file){
        $insert = DB::table($this->table)->insert([
            ['title' => $title, 'date' => $date, 'fkType' => $fkType, 'file' => $file]
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

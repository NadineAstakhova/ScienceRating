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

    public function insertArticle($idRes, $article, $publishing, $pages){
        $insert = DB::table('article_in_res')->insert([
            ['title' => $article, 'publishing' => $publishing, 'pages' => $pages, 'fkRes' => $idRes]
        ]);
        if ($insert)
            return true;
        else
            return false;
    }

}

<?php

namespace App\Models\RankingModels;

use Illuminate\Database\Eloquent\Model;

class CreateResult extends Model
{
    public $title;
    public $type;
    public $date;
    public $file;
    public $article;
    public $publishing;
    public $pages;


    public function createEvent($title,$date, $file, $fkType ){

        $res = new ScientificResult();
        $fileName = $file->getClientOriginalName();
        $path = base_path(). '/public/uploads/';
        $file->move($path , $fileName);

        return $res->insertEvent($title,$date, $fkType);
    }

    public function createPublication($title, $publishing, $pages, $date, $file, $fkType){
        $res = new ScientificResult();

        $fileName = $file->getClientOriginalName();
        $path = base_path(). '/public/uploads/';
        $file->move($path , $fileName);
        return $res->insertPublication($title, $publishing, $pages, $date, '/public/uploads/'. $fileName, $fkType);
    }





}

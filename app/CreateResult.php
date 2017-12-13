<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreateResult extends Model
{
    public $name;
    public $type;
    public $date;
    public $file;
    public $article;
    public $publishing;
    public $pages;


    public function createRes(){

        $res = new ScientificResult();
        $fileName = $this->file->getClientOriginalName();
        $path = base_path(). '/public/uploads/';
        $this->file->move($path , $fileName);

        return $res->insertResult($this->name, $this->date, $this->type, '/public/uploads/'. $fileName);
    }

    public function createArticle($idRes){
        $res = new ScientificResult();
        return $res->insertArticle($idRes, $this->article, $this->publishing, $this->pages);
    }



}

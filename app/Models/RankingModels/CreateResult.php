<?php

namespace App\Models\RankingModels;

use App\Models\UsersOwners;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class CreateResult extends Model
{
    public $title;
    public $type;
    public $date;
    public $file;
    public $article;
    public $publishing;
    public $pages;


    public function createEvent($title,$date, $file, $fkType, $forAllUser = null ){

        $res = new ScientificResult();
        if(!is_null($forAllUser)){
            $fileName = $file->getClientOriginalName();
            $unicodefileName = iconv('windows-1256', 'utf-8', $fileName);
            $path = base_path(). '/public/uploads/';
            $file->move($path , $unicodefileName);
            session()->put('fileNameAll', $fileName);
        }
        else
            if(Session::has('owners')){
                Session::forget('fileNameAll');
            }

        return $res->insertEvent($title,$date, $fkType);
    }

    public function createPublication($title, $publishing, $pages, $date, $file, $fkType){
        $res = new ScientificResult();

        $fileName = $file->getClientOriginalName();
        $path = base_path(). '/public/uploads/';
        $file->move($path , $fileName);
        return $res->insertPublication($title, $publishing, $pages, $date, '/public/uploads/'. $fileName, $fkType);
    }

    public function addOneAuthorToArticle($idUser, $last_id){
        $publication = new UsersOwners();
        return $publication->setAuthorsForPublication($last_id, $idUser, '100', 'new');

    }

    public function addOneMemberToEvent($idUser, $last_id, $file){
        $event = new UsersOwners();
    }





}

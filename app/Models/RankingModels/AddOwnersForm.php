<?php

namespace App\Models\RankingModels;

use App\Models\UsersOwners;
use Illuminate\Database\Eloquent\Model;

class AddOwnersForm extends Model
{
    public $idResult;
    public $arrOwners;
    public $arrRole;

    public function addEventMembers($arrOwners, $arrRole, $arrResult, $idResult, $action = null){
        $arrR = array();
        $arrRes = array();

        foreach ($arrRole as $key=>$value){
            if(array_key_exists($key, $arrOwners))
                $arrR[$key] = $value;
        }

        foreach ($arrResult as $key=>$value){
            if(array_key_exists($key, $arrOwners))
                $arrRes[$key] = $value;
        }
        $insertOwners = new UsersOwners();
        if(!is_null($action) ){
            return $insertOwners->editMembersOfEvent($idResult, $arrOwners, $arrR, $arrRes);
        }
        else
            return $insertOwners->setMembersOfEvent($idResult, $arrOwners, $arrR, $arrRes);

    }

    public function addPublicationAuthor($arrOwners, $arrRole, $idResult, $action = null){
        $arrR = array();
        foreach ($arrRole as $key=>$value){
            if(array_key_exists($key, $arrOwners))
                $arrR[$key] = $value;
        }
        $insertOwners = new UsersOwners();
        if(!is_null($action) ){
            return $insertOwners->editAuthorsForPublication($idResult, $arrOwners, $arrR);
        }
        return $insertOwners->setAuthorsForPublication($idResult, $arrOwners, $arrR);
    }

}

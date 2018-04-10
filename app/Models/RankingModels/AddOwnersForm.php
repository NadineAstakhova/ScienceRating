<?php

namespace App\Models\RankingModels;

use App\Models\UsersOwners;
use Illuminate\Database\Eloquent\Model;

class AddOwnersForm extends Model
{
    public $idResult;
    public $arrOwners;
    public $arrRole;

    public function addOwners(){
        $arrR = array();
        foreach ($this->arrRole as $key=>$value){
            if(array_key_exists($key, $this->arrOwners))
                $arrR[$key] = $value;
        }
        $insertOwners = new UsersOwners();
        return $insertOwners->setOwnersForResult($this->idResult, $this->arrOwners, $arrR);
    }

}

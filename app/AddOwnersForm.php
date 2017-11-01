<?php

namespace App;

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
      //  print_r($this->arrOwners);
        //print_r($arr);
        //echo $this->idResult;
        return $insertOwners->setOwnersForResult($this->idResult, $this->arrOwners, $arrR);
    }

}

<?php

namespace App\Models\RankingModels;

use Illuminate\Database\Eloquent\Model;

class EditResults extends Model
{
    public function getArrayStatusForNewAllResults($arrIdResults, $arrStatus, $status){
        $data = array();
        for ($i = 0; $i < count($arrIdResults); $i++){
            if(strcmp($arrStatus[$i],  $status) == 0)
                array_push($data, $arrIdResults[$i]);
        }

        if(count($data) > 0)
            return $data;
        else
            return 0;
    }

    public function editStatusForNewResults($arrIdEvents, $arrStatusEvents, $arrIdPublications, $arrStatusPub){
        $arrStatusConfForPub = $this->getArrayStatusForNewAllResults($arrIdPublications, $arrStatusPub, 'confirmed');
        $arrStatusConfForEvents = $this->getArrayStatusForNewAllResults($arrIdEvents, $arrStatusEvents, 'confirmed');

        if($arrStatusConfForPub !== 0){
            ScientificResult::setStatusOfPublications($arrStatusConfForPub, 'confirmed');
        }
        if($arrStatusConfForEvents !== 0){
            ScientificResult::setStatusOfEvents($arrStatusConfForEvents, 'confirmed');
        }

        $arrStatusUnConfForPub = $this->getArrayStatusForNewAllResults($arrIdPublications, $arrStatusPub, 'unconfirmed');
        $arrStatusUnConfForEvents = $this->getArrayStatusForNewAllResults($arrIdEvents, $arrStatusEvents, 'unconfirmed');

        if($arrStatusUnConfForPub !== 0){
            ScientificResult::setStatusOfPublications($arrStatusUnConfForPub, 'unconfirmed');
        }
        if($arrStatusUnConfForEvents !== 0){
            ScientificResult::setStatusOfEvents($arrStatusUnConfForEvents, 'unconfirmed');
        }

        return true;
    }

    public function editEventInfoForm($id, $title, $date, $fkType){
        $edit = new ScientificEvent($id);
        $edit->editEventInfo($title, $date, $fkType);
       return true;

    }

    public function editPublicationInfoForm($id, $title, $date, $fkType, $edition, $pages){
        $edit = new ScientificPublication($id);
        $edit->editPublicationInfo($title, $date, $fkType,$edition, $pages);
        return true;

    }
}

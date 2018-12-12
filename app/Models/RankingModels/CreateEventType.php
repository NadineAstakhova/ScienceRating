<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 11/12/2018
 * Time: 14:57
 */

namespace App\Models\RankingModels;


use Illuminate\Database\Eloquent\Model;
use DB;
use Symfony\Component\VarDumper\Cloner\Data;

/**
 * Class CreateEventType
 * @package App\Models\RankingModels
 */
class CreateEventType extends Model
{
    /**
     * Create New Type of Event
     * @param $title
     * @param $tempId
     * @param $idRes
     * @param $mark
     * @param $code
     * @return bool
     */
    public function createNewEventType($title, $tempId, $idRes, $mark, $code){
        $temp = new DataInRanking($tempId);
        return $temp->createNewEventTypeInRank($title, $tempId, $idRes, $mark, $code);
    }

    /**
     * Create New Type of Publication
     * @param $title
     * @param $tempId
     * @param $mark
     * @param $code
     * @return bool
     */
    public function createNewPubType($title, $tempId, $mark, $code){
        $temp = new DataInRanking($tempId);
        return $temp->createNewPubTypeInRank($title, $tempId, $mark, $code);
    }

    /**
     * @param $arrTypes
     * @param $arrMarks
     * @param $arrCodes
     * @param $idRanking
     * @return bool
     */
    public function addTypesOfPub($arrTypes, $arrMarks, $arrCodes, $idRanking){

        $arrM = array();
        $arrC = array();

        foreach ($arrMarks as $key=>$value){
            if(array_key_exists($key, $arrTypes))
                $arrM[$key] = $value;
        }

        foreach ($arrCodes as $key=>$value){
            if(array_key_exists($key, $arrTypes))
                $arrC[$key] = $value;
        }

        $addType = new DataInRanking($idRanking);

        return $addType->addExistedTypeOfPub($arrTypes, $idRanking, $arrM, $arrC);
    }

    /**
     * @param $idRanking
     * @param $idType
     * @param $mark
     * @param $code
     * @param $idRes
     * @return mixed
     */
    public function addTypesOfEvent($idRanking, $idType, $mark, $code, $idRes){
        $addType = new DataInRanking($idRanking);

        return $addType->addExistedTypeOfEvent($idRanking, $idType, $mark, $code, $idRes);
    }

    /**
     * @param $id
     * @param $newValueMark
     * @param $newValueCode
     * @return mixed
     */
    public function editMarkAndCodeEvent($id, $newValueMark, $newValueCode){
        $edit = DataInRanking::editMarkAndCodeEvent($id, $newValueMark, $newValueCode);
        return $edit;
    }

    /**
     * @param $id
     * @param $newValueMark
     * @param $newValueCode
     * @return mixed
     */
    public function editMarkOfCodePub($id, $newValueMark, $newValueCode){
        $edit = DataInRanking::editMarkOfCodePub($id, $newValueMark, $newValueCode);
        return $edit;
    }




}
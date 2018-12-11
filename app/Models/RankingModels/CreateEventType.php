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


}
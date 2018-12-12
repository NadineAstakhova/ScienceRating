<?php

namespace App\Models\RankingModels;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use DB;
/**
 * Class DataInRanking or identify data in ranking
 * @package App\Models\RankingModels
 */
class DataInRanking extends BaseModel
{
    protected $primaryKey = 'idTemplate';
    protected $table = 'res_template';
    protected $fillable = array('title');

    private $idTemp;

    /**
     * DataInRanking constructor.
     * @param $idTemp
     * @param array $attributes
     */
    public function __construct($idTemp, $attributes = [])
    {
        $this->idTemp = $idTemp;
        parent::__construct($attributes);
    }

    /**
     * @return mixed
     */
    public function getId(){
        return $this->idTemp;
    }

    /**
     * Get types of publications in ranking
     * @return mixed
     */
    public function getPublicationAtTemp(){
        $publications = DB::table('publication_in_ranking')
            ->join('type_of_publication', 'type_of_publication.idTypePub', '=', 'publication_in_ranking.fk_type_pub')
            ->where('fk_rank_type', '=', $this->idTemp)
            ->get();
        return $publications;
    }

    /**
     * Get types of events in ranking
     * @return mixed
     */
    public function getEventsAtTemp(){
        $events = DB::table('event_in_ranking')
            ->join('type_of_scient_event', 'type_of_scient_event.idTypeEvents', '=', 'event_in_ranking.fk_event_type')
            ->join('type_of_result', 'type_of_result.idTypeRes', '=', 'event_in_ranking.fk_result_type')
            ->where('fk_rank_type', '=', $this->idTemp)
            ->get();
        return $events;
    }

    /**
     * Get all types in rankings
     * @return mixed
     */
    public function getTypesAtTemp(){
        $publications = $this->getPublicationAtTemp();
        $events = $this->getEventsAtTemp();
        $arrTypes =  $events->merge($publications);
        return $arrTypes;
    }

    /**
     * Get title of ranking
     * @return mixed
     */
    public function getTitle(){
        $rank = DB::table($this->table)
            ->where('idTemplate', '=', $this->idTemp)
            ->first();
        return $rank->title;
    }

    /**
     * Delete event from ranking
     * @param $idDelete
     * @return mixed
     */
    public static function deleteEventAtRanking($idDelete){
        $deleted =  DB::table('event_in_ranking')->where('idRankEvent','=',$idDelete)->delete();
        return $deleted;
    }

    /**
     * Delete publication from ranking
     * @param $idDelete
     * @return mixed
     */
    public static function deletePubAtRanking($idDelete){
        $deleted =  DB::table('publication_in_ranking')->where('idPubRank','=',$idDelete)->delete();
        return $deleted;
    }

    /**
     * Create new type of event and add to ranking
     * @param $title
     * @param $idRank
     * @param $idRes
     * @param $mark
     * @param $code
     * @return bool
     */
    public function createNewEventTypeInRank($title, $idRank, $idRes, $mark, $code){
        $newType = new TypeOfRes();
        if($newType->createEventType($title)){
            $last_id = DB::getPdo()->lastInsertId();
            $insert = DB::table('event_in_ranking')->insert([
                ['fk_rank_type' => $idRank, 'fk_event_type' => $last_id, 'fk_result_type' => $idRes, 'mark' => $mark, 'code' => $code]
            ]);
            return $insert;
        }
        else
            return false;
    }

    /**
     *  Create new type of publication and add to ranking
     * @param $title
     * @param $idRank
     * @param $mark
     * @param $code
     * @return bool
     */
    public function createNewPubTypeInRank($title, $idRank, $mark, $code){
        $newType = new TypeOfRes();
        if($newType->createPubType($title)){
            $last_id = DB::getPdo()->lastInsertId();
            $insert = DB::table('publication_in_ranking')->insert([
                ['fk_rank_type' => $idRank, 'fk_type_pub' => $last_id,  'mark' => $mark, 'code' => $code]
            ]);
            return $insert;
        }
        else
            return false;
    }

    /**
     * @param $arrTypes
     * @param $idRank
     * @param $arrMarks
     * @param $arrCodes
     * @return bool
     */
    public function addExistedTypeOfPub($arrTypes, $idRank, $arrMarks, $arrCodes){
        $insert = false;
        if (is_array($arrTypes)){
            foreach ($arrTypes as $key=>$value){
                $insert = DB::table('publication_in_ranking')->insert([
                    ['fk_rank_type' => $idRank, 'fk_type_pub' => $arrTypes[$key], 'mark' => $arrMarks[$key], 'code' => $arrCodes[$key]]
                ]);
            }
        }
        else
            $insert = DB::table('publication_in_ranking')->insert([
                ['fk_rank_type' => $idRank, 'fk_type_pub' => $arrTypes, 'mark' => $arrMarks, 'code' => $arrCodes]
            ]);

        if ($insert)
            return true;
        else
            return false;
    }

    public function getTypeOfEventWithResultInTemp($idTemp, $idType){
        $events = DB::table('event_in_ranking')
            ->join('type_of_scient_event', 'type_of_scient_event.idTypeEvents', '=', 'event_in_ranking.fk_event_type')
            ->join('type_of_result', 'type_of_result.idTypeRes', '=', 'event_in_ranking.fk_result_type')
            ->where([['fk_rank_type', '=', $idTemp], ['fk_event_type', '=', $idType]])
            ->get();
        return $events;
    }

    public function getNotExistedResultTypeOfEventInTemp($idTemp, $idType){
        $resultTypes =  TypeOfRes::getResultTypes();
        $events = $this->getTypeOfEventWithResultInTemp($idTemp, $idType);
        foreach($events as $event){
            if(array_key_exists($event->fk_result_type, $resultTypes)){
                unset($resultTypes[$event->fk_result_type]);
            }
        }
        return $resultTypes;
    }

    public function addExistedTypeOfEvent($idRanking, $idType, $mark, $code, $idRes){
        $insert = DB::table('event_in_ranking')->insert([
            ['fk_rank_type' => $idRanking, 'fk_event_type' => $idType, 'mark' => $mark, 'code' => $code, 'fk_result_type' => $idRes]
        ]);
        return $insert;
    }



}

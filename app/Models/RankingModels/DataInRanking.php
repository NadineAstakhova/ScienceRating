<?php

namespace App\Models\RankingModels;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use DB;

class DataInRanking extends BaseModel
{
    protected $primaryKey = 'idTemplate';
    protected $table = 'res_template';
    protected $fillable = array('title');

    private $idTemp;

    public function __construct($idTemp, $attributes = [])
    {
        $this->idTemp = $idTemp;
        parent::__construct($attributes);
    }

    public function getPublicationAtTemp(){
        $publications = DB::table('publication_in_ranking')
            ->join('type_of_publication', 'type_of_publication.idTypePub', '=', 'publication_in_ranking.fk_type_pub')
            ->where('fk_rank_type', '=', $this->idTemp)
            ->get();
        return $publications;
    }

    public function getEventsAtTemp(){
        $events = DB::table('event_in_ranking')
            ->join('type_of_scient_event', 'type_of_scient_event.idTypeEvents', '=', 'event_in_ranking.fk_event_type')
            ->join('type_of_result', 'type_of_result.idTypeRes', '=', 'event_in_ranking.fk_result_type')
            ->where('fk_rank_type', '=', $this->idTemp)
            ->get();
        return $events;
    }

    //get all types in rankings
    public function getTypesAtTemp(){
        $publications = $this->getPublicationAtTemp();
        $events = $this->getEventsAtTemp();
        $arrTypes =  $events->merge($publications);
        return $arrTypes;
    }

    //title of ranking
    public function getTitle(){
        $rank = DB::table($this->table)
            ->where('idTemplate', '=', $this->idTemp)
            ->first();
        return $rank->title;
    }


}

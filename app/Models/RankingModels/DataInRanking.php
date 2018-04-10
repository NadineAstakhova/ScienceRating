<?php

namespace App\Models\RankingModels;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use DB;

class DataInRanking extends BaseModel
{
    protected $primaryKey = 'idRes_in_template';
    protected $table = 'res_in_template';
    protected $fillable = array('fkType', 'fkTemp', 'mark');

    private $idTemp;

    public function __construct($idTemp, $attributes = [])
    {
        $this->idTemp = $idTemp;
        parent::__construct($attributes);
    }

    public function getTypesAtTemp(){
        $types = DB::table($this->table)
            ->join('type_of_scient_res', 'type_of_scient_res.idType_certificates', '=', 'res_in_template.fkType')
            ->where('fkTemp', '=', $this->idTemp)
            ->get();
        return $types;
    }

    public function getTitle(){
        $title = DB::table('res_template')
            ->where('idTemplate', '=', $this->idTemp)
            ->first();
        return $title->title;
    }


}

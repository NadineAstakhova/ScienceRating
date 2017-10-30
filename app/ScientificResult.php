<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ScientificResult extends BaseModel
{
    protected $primaryKey = 'idRes';
    protected $table = 'scientific_result';
    protected $fillable = array('title', 'date', 'fkType', 'file');

    public function insertResult($title, $date, $fkType, $file){
        $insert = DB::table($this->table)->insert([
            ['title' => $title, 'date' => $date, 'fkType' => $fkType, 'file' => $file]
        ]);
        if ($insert)
            return true;
        else
            return false;
    }

}

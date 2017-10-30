<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScientificResult extends BaseModel
{
    protected $primaryKey = 'idRes';
    protected $table = 'scientific_result';
    protected $fillable = array('title', 'date', 'fkType', 'file');

    public function insertResult(){
        
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreateResult extends Model
{
    public $name;
    public $type;
    public $date;
    public $file;

    public function createRes(){

        echo $this->name;
        echo $this->type;
        $res = new ScientificResult();

        return $res->insertResult($this->name, $this->date, $this->type, $this->file);

    }



}

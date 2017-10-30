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
        echo $this->file;

        $res = new ScientificResult();
        $fileName = $this->file->getClientOriginalName();
        $path = base_path(). '/public/uploads/';
        echo $path;
        $this->file->move($path , $fileName);

        return $res->insertResult($this->name, $this->date, $this->type, '/public/uploads/'. $fileName);

    }



}

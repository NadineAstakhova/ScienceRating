<?php

namespace App\Http\Controllers;

use App\CreateResult;
use App\Http\Requests\CreateResultFormRequest;
use App\TypeOfRes;
use Illuminate\Http\Request;

class ProfileController extends Controller
{


    public function index() {
        return view('panel\profile');
    }


    public function createResultPage(){
        return view('panel\createRes',
            array('title' => 'createRes','description' => '',
                'page' => 'createRes', 'arrType' => TypeOfRes::getAll()));
    }

    public function createResultForm(CreateResultFormRequest $request){
        $model = new CreateResult();
        $model->name = $request->get('name');
        $model->type = $request->get('type');
        $model->file = $request->get('file');
        $model->date = $request->get('date');

        if ($model->createRes()){
           // return redirect('subjects/'.$idProf)->with('save', 'Дисциплина успешно добавлена/изменена');
            return "ura";
        }
        else
            return 0;
            //return redirect('subjects/'.$idProf)->with('error', 'Ошибка записи');
    }
}

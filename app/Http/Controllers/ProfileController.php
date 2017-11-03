<?php

namespace App\Http\Controllers;

use App\AddOwnersForm;
use App\CreatePdfReport;
use App\CreateResult;
use App\Http\Requests\AddOwnersFormRequest;
use App\Http\Requests\CreateResultFormRequest;
use App\TypeOfRes;
use App\UsersOwners;
use Illuminate\Http\Request;
use DB;

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

        //$request->file->store('file');
        $model->file = $request->file('file');

        $model->date = $request->get('date');

        $model->article = $request->get('article');
        $model->publishing = $request->get('publishing');
        $model->pages = $request->get('pages');


        if ($model->createRes()){
            if(!is_null($model->article))
                $model->createArticle(DB::getPdo()->lastInsertId());
            return redirect('createres/'.DB::getPdo()->lastInsertId());
            //return "ura";
        }
        else
            return 0;
            //return redirect('subjects/'.$idProf)->with('error', 'Ошибка записи');
    }

    public function createResultOwner($idRes){
        return view('panel\createResSetOwners',
            array('title' => 'createResSetOwners','description' => '',
                'page' => 'createResSetOwners',
                'idResult' => $idRes,
                'arrUsers' => UsersOwners::getAllUsersForTable()));
    }

    public function createResultOwnerForm($idResult, AddOwnersFormRequest $request){
        $model = new AddOwnersForm();
        $model->arrOwners = $request->get('arrOwners');
        $model->arrRole = $request->get('arrRole');
        $model->idResult = $idResult;
        if($model->addOwners()){
            return redirect('profile')->with('save', 'Научный результат успешно добавлен');
        }
        else
            return redirect('profile')->with('error', 'Ошибка записи');
    }

    public function createRatingPage(){
        return view('panel\createrating',
            array('title' => 'createrating','description' => '',
                'page' => 'createrating'));
    }

    public function createPdfReport($idOwner){
       $model = new CreatePdfReport();
      //return $model->createPdf('test', 'need', '1', '2');
       return $model->t($idOwner);
    }
}

<?php

namespace App\Http\Controllers;

use App\AddOwnersForm;
use App\CertificatPdfParse;
use App\CreatePdfReport;
use App\CreateResult;
use App\Http\Requests\AddOwnersFormRequest;
use App\Http\Requests\CreateResultFormRequest;
use App\TypeOfRes;
use App\UsersOwners;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{


    public function index() {
        return view('panel/profile');
    }


    public function createResultPage(){
        return view('panel/createRes',
            array('title' => 'createRes','description' => '',
                'page' => 'createRes', 'arrType' => TypeOfRes::getAll()));
    }

    public function createResultForm(CreateResultFormRequest $request){
        //get data from request
        $model = new CreateResult();
        $model->name = $request->get('name');
        $model->type = $request->get('type');
        $model->file = $request->file('file');

        $model->date = $request->get('date');

        $model->article = $request->get('article');
        $model->publishing = $request->get('publishing');
        $model->pages = $request->get('pages');

        $model->parsePDF = $request->get('allField');

        //if automatic document parsing is selected
        if(!is_null($model->parsePDF)){
           //parse file
           $parseFile = new CertificatPdfParse($model->file);
           $content = $parseFile->getContent();
           if ($content == '0')
               return redirect('createres')->with('errorParse', 'Что-то не так с вашим файлом. Мы не можем его распознать');

           //searching our users in text
           $users = $parseFile->searchUserAtPdf();
           $searchDate = $parseFile->searchDate();
           $searchTitle = $parseFile->serachTitle();

            return view('panel/createRes',
                array('title' => 'createRes','description' => '',
                    'page' => 'createRes', 'arrType' => TypeOfRes::getAll(),
                    'pdfText' => $content,
                    'users' => $users,
                    'date' => $searchDate,
                    'searchTitle' => $searchTitle,
                ));
        }

        if ($model->createRes()){
            if(!is_null($model->article))
                $model->createArticle(DB::getPdo()->lastInsertId());
            return redirect('createres/'.DB::getPdo()->lastInsertId())->with('owners', $request->get('owners'));
        }
        else
            return 0;
    }

    public function createResultOwner($idRes){
        return view('panel/createResSetOwners',
            array('title' => 'createResSetOwners','description' => '',
                'page' => 'createResSetOwners',
                'idResult' => $idRes,
                'arrUsers' => Session::has('owners') ?
                    UsersOwners::getAllUsersForTable(Session::get("owners")) : UsersOwners::getAllUsersForTable()));
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
        return view('panel/createrating',
            array('title' => 'createrating','description' => '',
                'page' => 'createrating'));
    }

    public function createPdfReport($idTemp){
       $model = new CreatePdfReport();
       $idOwner = Input::get('owner_id');

      //return $model->createPdf('test', 'need', '1', '2');
       return $model->createPdf($idTemp, $idOwner);
    }
}

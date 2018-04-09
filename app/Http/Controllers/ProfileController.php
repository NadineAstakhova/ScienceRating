<?php

namespace App\Http\Controllers;

use App\Models\RankingModels\AddOwnersForm;
use App\Models\RankingModels\CertificatPdfParse;
use App\Models\RankingModels\CreateResult;
use App\Models\RankingModels\TypeOfRes;
use App\Models\ReportModels\CreateDocReport;

use App\Http\Requests\AddOwnersFormRequest;
use App\Http\Requests\CreateResultFormRequest;

use App\Models\ReportModels\CreatePdfReport;
use App\Models\UsersModels\Professor;
use App\Models\UsersOwners;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


class ProfileController extends Controller
{


    public function index() {
        return view('panel/profile');
    }

    public function professorProfile() {
       $professor = Professor::findIdentity( Auth::user()->idUsers);
       session()->put('professor', $professor);
       return view('usersPanel/professorProfile',
            array('title' => 'professorProfile','description' => '',
                'page' => 'professorProfile', 'professor' =>   $professor));
    }


    public function createResultPage(){
        return view('panel/addResultForms/createRes',
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

            return view('panel/addResultForms/createRes',
                array('title' => 'createRes','description' => '',
                    'page' => 'createRes', 'arrType' => TypeOfRes::getAll(),
                    'pdfText' => $content,
                    'users' => $users,
                    'date' => $searchDate,
                    'searchTitle' => $searchTitle,
                ));
        }

        if ($model->createRes()){
            $last_id = DB::getPdo()->lastInsertId();
            if(!is_null($model->article)) {
                $model->createArticle($last_id);
            }
            return redirect('createres/'.$last_id)->with('owners', $request->get('owners'));
        }
        else
            return 0;
    }

    public function createResultOwner($idRes){
        return view('panel/addResultForms/createResSetOwners',
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
        return view('panel/showRankigs/createrating',
            array('title' => 'createrating','description' => '',
                'page' => 'createrating',
                'arrArticles' => UsersOwners::countOfArticles(UsersOwners::getAllUsersForTable()),
            )
        );
    }

    public function createPdfReport($idTemp, $idOwner){
       $model = new CreatePdfReport();
     //  $idOwner = Input::get('owner_id');

      //return $model->createPdf('test', 'need', '1', '2');
       return $model->createPdf($idTemp, $idOwner);
    }

    public function createDocReport($idTemp, $idOwner){
        $model = new CreateDocReport();
        $model->createDoc($idTemp, $idOwner);
    }

    public function showUsers(){
        return view('panel/userRating/users',
            array('title' => 'users','description' => '',
                'page' => 'users',
                'arrUsers' => UsersOwners::getAllUsersForTable()));
    }

    public function showUserResult($idUser){
        return view('panel/userRating/showUserResult',
            array('title' => 'showUserResult','description' => '',
                'page' => 'showUserResult',
                'user' => UsersOwners::getUserById($idUser),
                'arrResults' => UsersOwners::userResults($idUser)));
    }

    public function showArticles($id){
        $articles = UsersOwners::articlesByID($id);
        $user = UsersOwners::getUserById($id);
        return view('panel/showRankigs/articles', compact('articles', 'user'));
    }

    public function infoProfile(){
        return view('usersPanel/infoProfile',
            array('title' => 'infoProfile','description' => '',
                'page' => 'infoProfile', 'professor' =>   session()->get('professor')));
    }

    /**
     * Function for updating professor info at two tables Users and Professor
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUserInfoForm(Request $request){
        $updateInfo = new Professor();
        try {
            //TODO add ukr and en
            $updateInfoProf = $updateInfo->updateProfInfo(
                session()->get('professor')->id,
                $request->get('name'),
                $request->get('surname'),
                $request->get('patronymic')
            );
            $updateInfoUser =  $updateInfo->updateUserInfo(
                session()->get('professor')->idUsers,
                $request->get('email')
            );
            if(($updateInfoProf && $updateInfoUser) || ($updateInfoProf || $updateInfoUser)){
                 return redirect('professorProfile')->with('save', 'Данные успешно изменены');
            }
            else
                 return redirect('professorProfile')->with('error', 'Ошибка при измении данных');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('professorProfile')->with('error', 'Ошибка при измении данных');
        } catch (\Exception $e) {
            return redirect('professorProfile')->with('error', 'Ошибка при измении данных');
        }



    }


}

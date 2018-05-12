<?php

namespace App\Http\Controllers;

use App\Models\RankingModels\AddOwnersForm;
use App\Models\RankingModels\CertificatPdfParse;
use App\Models\RankingModels\CreateResult;
use App\Models\RankingModels\EditResults;
use App\Models\RankingModels\ScientificEvent;
use App\Models\RankingModels\ScientificPublication;
use App\Models\RankingModels\ScientificResult;
use App\Models\RankingModels\TypeOfRes;
use App\Models\ReportModels\CreateDocReport;

use App\Http\Requests\AddOwnersFormRequest;
use App\Http\Requests\CreateResultFormRequest;

use App\Models\ReportModels\CreatePdfReport;
use App\Models\UsersModels\Professor;
use App\Models\UsersModels\Student;
use App\Models\UsersOwners;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;


class ProfileController extends Controller
{


    public function index() {

        return view('panel/profile',
            array('title' => 'profile','description' => '',
                'page' => 'profile', 'countOfNewResults' =>   ScientificResult::getCountOfAllNewResults()));
    }

    public function professorProfile() {
       $professor = Professor::findIdentity( Auth::user()->idUsers);
       session()->put('professor', $professor);
       return view('usersPanel/userProfile',
            array('title' => 'userProfile','description' => '',
                'page' => 'userProfile', 'user' =>   $professor));
    }

    public function studentProfile() {
        $student = Student::findIdentity( Auth::user()->idUsers);
        session()->put('student', $student);
        return view('usersPanel/userProfile',
            array('title' => 'userProfile','description' => '',
                'page' => 'userProfile', 'user' =>   $student));
    }


    public function createArticlePage($idUser = null){
        if(is_null($idUser))
            return view('panel/addResultForms/createPublication',
                array('title' => 'createPublication','description' => '',
                    'page' => 'createPublication', 'arrType' => TypeOfRes::getPublicationTypes()));
        else
            return view('panel/addResultForms/createPublication',
                array('title' => 'createPublication','description' => '',
                    'page' => 'createPublication', 'arrType' => TypeOfRes::getPublicationTypes(), 'idUser' => $idUser));
    }

    public function createArticleForm($idUser = null, CreateResultFormRequest $request){
        //get data from request
        $model = new CreateResult();

        $title = $request->get('name');
        $publishing = $request->get('publishing');
        $pages =  $request->get('pages');
        $date =  $request->get('date');
        $file =  $request->file('file');
        $fkType =  $request->get('type');


        $parsePDF = $request->get('allField');

        //if automatic document parsing is selected
        if(!is_null($parsePDF)){
           //parse file
           $parseFile = new CertificatPdfParse($file);
           $content = $parseFile->getContent();
           if ($content == '0')
               return redirect('createres')->with('errorParse', 'Что-то не так с вашим файлом. Мы не можем его распознать');

           //searching our users in text
           $users = $parseFile->searchUserAtPdf();
           $searchDate = $parseFile->searchDate();
           $searchTitle = $parseFile->serachTitle();

            return view('panel/addResultForms/createPublication',
                array('title' => 'createPublication','description' => '',
                    'page' => 'createPublication', 'arrType' =>TypeOfRes::getPublicationTypes(),
                    'pdfText' => $content,
                    'users' => $users,
                    'date' => $searchDate,
                    'searchTitle' => $searchTitle,
                ));
        }

        if ($model->createPublication($title, $publishing, $pages, $date, $file, $fkType)){
            $last_id = DB::getPdo()->lastInsertId();
            if(is_null($idUser))
                return redirect('addArticleAuthor/'.$last_id)->with('owners', $request->get('owners'));
            else{
                //percent????
                $model->addOneAuthorToArticle($idUser, $last_id);
                return redirect('profile')->with('save', 'Научный результат успешно добавлен');
            }
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


    public function addPublicationAuthorForm($idResult, AddOwnersFormRequest $request){
        $model = new AddOwnersForm();
        $model->arrOwners = $request->get('arrOwners');
        $model->arrRole = $request->get('arrRole');
        $model->idResult = $idResult;
        if($model->addPublicationAuthor($request->get('arrOwners'), $request->get('arrRole'), $idResult)){
            return redirect('profile')->with('save', 'Научный результат успешно добавлен');
        }
        else
            return redirect('profile')->with('error', 'Ошибка записи');
    }


    public function createEventPage(){
        return view('panel/addResultForms/createEvent',
            array('title' => 'createEvent','description' => '',
                'page' => 'createEvent', 'arrType' => TypeOfRes::getEventTypes()));
    }

    public function createEventForm($idUser = null, CreateResultFormRequest $request){
        //get data from request
        $model = new CreateResult();

        $title = $request->get('name');
        $date =  $request->get('date');
        $file =  $request->file('file');
        $fkType =  $request->get('type');
        $forAllUser = $request->get('forAllUser');


        $parsePDF = $request->get('allField');


        //if automatic document parsing is selected
        if(!is_null($parsePDF)){
            //parse file
            $parseFile = new CertificatPdfParse($file);
            $content = $parseFile->getContent();
            if ($content == '0')
                return redirect('createResult')->with('errorParse', 'Что-то не так с вашим файлом. Мы не можем его распознать');

            //searching our users in text
            $users = $parseFile->searchUserAtPdf();
            $searchDate = $parseFile->searchDate();
            $searchTitle = $parseFile->serachTitle();

            return view('panel/addResultForms/createEvent',
                array('title' => 'createRes','description' => '',
                    'page' => 'createRes', 'arrType' =>  TypeOfRes::getEventTypes(),
                    'pdfText' => $content,
                    'users' => $users,
                    'date' => $searchDate,
                    'searchTitle' => $searchTitle,
                ));
        }

        if ($model->createEvent($title,  $date, $file, $fkType, $forAllUser)){
            $last_id = DB::getPdo()->lastInsertId();
            if(is_null($idUser))
                return redirect('addEventAuthor/'.$last_id)->with('owners', $request->get('owners'));
            else{
                $model->addOneMemberToEvent($idUser, $last_id, $file);
                return redirect('profile')->with('save', 'Научный результат успешно добавлен');
            }

        }
        else
            return redirect('profile')->with('error', 'Ошибка записи');
    }

    public function memberOfEventPage($idRes){
        return view('panel/addResultForms/createResSetOwners',
            array('title' => 'createResSetOwners','description' => '',
                'page' => 'createResSetOwners',
                'idResult' => $idRes,
                'arrUsers' => Session::has('owners') ?
                    UsersOwners::getAllUsersForTable(Session::get("owners")) : UsersOwners::getAllUsersForTable(),
                'arrRoles' => TypeOfRes::getRolesTypes(),
                'arrResults' => TypeOfRes::getResultTypes()));
    }


    //TODO validation
    public function addEventMembersForm($idResult, AddOwnersFormRequest $request){
        $model = new AddOwnersForm();
        $model->arrOwners = $request->get('arrOwners');
        $model->arrRole = $request->get('arrRole');
        $model->idResult = $idResult;
        $file = "";
        if(Session::has('fileNameAll')){
           $file = Session::get("fileNameAll");
        }
        else
            $file =  $request->file('arrFiles');
        if($model->addEventMembers($request->get('arrOwners'), $request->get('arrRole'),
            $request->get('arrResults'), $idResult, $file)){
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
                'arrArticles' => UsersOwners::articlesByID($idUser),
                'arrEvents' => UsersOwners::getUserEvents($idUser)
            ));
    }

    public function showArticles($id){
        $articles = UsersOwners::articlesByID($id, 'confirmed');
        $user = UsersOwners::getUserById($id);
        return view('panel/showRankigs/articles', compact('articles', 'user'));
    }

    public function infoProfile(){
        if(Auth::user()->type == '1'){
            return view('usersPanel/infoProfile',
                array('title' => 'infoProfile','description' => '',
                    'page' => 'infoProfile', 'user' =>   session()->get('professor')));
        }
        if(Auth::user()->type == '2'){
            return view('usersPanel/infoProfile',
                array('title' => 'infoProfile','description' => '',
                    'page' => 'infoProfile', 'user' =>   session()->get('student')));
        }
        if(Auth::user()->type == '3'){
            return view('panel/infoProfileMethodist',
                array('title' => 'infoProfileMethodist','description' => '',
                    'page' => 'infoProfileMethodist', 'user' =>   Auth::user()));
        }

    }

    /**
     * Function for updating professor info at two tables Users and Professor
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUserInfoForm(Request $request){
        $updateInfo = new Professor();
        try {
            $updateInfoProf = $updateInfo->updateProfInfo(
                session()->get('professor')->id,
                $request->get('name'),
                $request->get('surname'),
                $request->get('patronymic'),
                $request->get('name_ukr'),
                $request->get('surname_ukr'),
                $request->get('patronymic_ukr'),
                $request->get('name_en'),
                $request->get('surname_en')
            );
            $updateInfoUser =  User::updateUserInfo(
                session()->get('professor')->idUsers,
                $request->get('email')
            );
            if (strlen($request->get('new_password')) != 0)
                $updatePass = User::updatePass(session()->get('professor')->idUsers, Hash::make($request->get('new_password')));
            else
                $updatePass = 0;
            if(($updateInfoProf && $updateInfoUser) || ($updateInfoProf || $updateInfoUser) || $updatePass){
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


    /**
     * Function for updating student info at two tables Users and Student
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStudentInfoForm(Request $request){
        $updateInfo = new Student();
        try {
            $updateInfoProf = $updateInfo->updateStudentInfo(
                session()->get('student')->id,
                $request->get('name'),
                $request->get('surname'),
                $request->get('patronymic'),
                $request->get('name_ukr'),
                $request->get('surname_ukr'),
                $request->get('patronymic_ukr'),
                $request->get('name_en'),
                $request->get('surname_en')
            );
            $updateInfoUser =  User::updateUserInfo(
                session()->get('student')->idUsers,
                $request->get('email')
            );
            if (strlen($request->get('new_password')) != 0)
                $updatePass = User::updatePass(session()->get('student')->idUsers, Hash::make($request->get('new_password')));
            else
                $updatePass = 0;
            if(($updateInfoProf && $updateInfoUser) || ($updateInfoProf || $updateInfoUser) || $updatePass){
                return redirect('studentProfile')->with('save', 'Данные успешно изменены');
            }
            else
                return redirect('studentProfile')->with('error', 'Ошибка при измении данных');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('studentProfile')->with('error', 'Ошибка при измении данных');
        } catch (\Exception $e) {
            return redirect('studentProfile')->with('error', 'Ошибка при измении данных');
        }
    }

    public function updateMethodistInfoForm(Request $request){
        try {
            $updateInfoUser =  User::updateUserInfo(
                Auth::user()->idUsers,
                $request->get('email')
            );
            if (strlen($request->get('new_password')) != 0)
                $updatePass = User::updatePass(Auth::user()->idUsers, Hash::make($request->get('new_password')));
            else
                $updatePass = 0;
            if(($updatePass && $updateInfoUser) ||  ($updateInfoUser || $updatePass)){
                return redirect('profile')->with('save', 'Данные успешно изменены');
            }
            else
                return redirect('profile')->with('error', 'Ошибка при измении данных');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('profile')->with('error', 'Ошибка при измении данных');
        } catch (\Exception $e) {
            return redirect('profile')->with('error', 'Ошибка при измении данных');
        }

    }

    public function acceptResultsPage(){
        return view('panel/userRating/acceptResults',
            array('title' => 'createrating','description' => '',
                'page' => 'createrating',
                'arrNewEvents' => ScientificResult::getAllNewEvents(),
                'arrNewPublications' => ScientificResult::getAllNewPublications()
            )
        );
    }

    public  function changeStatusForNewResForm(Request $request){
        $model = new EditResults();

        if($model->editStatusForNewResults($request->get('arrResults'), $request->get('arrStatusRes'),
                $request->get('arrPublications'), $request->get('arrStatusPub'))

        ){
            return redirect('profile')->with('save', 'Научный результат успешно добавлен');
        }
        //else
        //    return redirect('profile')->with('error', 'Ошибка записи');
    }

    public function showInfoAboutResult($idEvent){
        $event = new ScientificEvent($idEvent);
        $members = $event->getMembers();
        $arrUser = array();
        $i = 0;
        foreach ($members as $user) {
                $arrUser[$i] = $user->idUsers;
                $i++;
        }
        session()->put('owners', $arrUser);
        return view('panel/resultsPages/infoRes',
            array('title' => 'createrating','description' => '',
                'page' => 'createrating',
                'event' => $event->identifyEvent(),
                'members' =>$members ,
                'arrType' => TypeOfRes::getEventTypes(),
            )
        );
    }

    public  function editEventInfoForm($idEvent, Request $request){
        $model = new EditResults();
        if($model->editEventInfoForm($idEvent, $request->get('name'), $request->get('date'),$request->get('type'))

        ){
            return redirect('profile')->with('save', 'Научный результат успешно обновлён');
        }
        else
            return redirect('profile')->with('error', 'Ошибка записи');
    }

    public function editEventMembersForm($idResult, AddOwnersFormRequest $request){
        $model = new AddOwnersForm();
        $model->arrOwners = $request->get('arrOwners');
        $model->arrRole = $request->get('arrRole');
        $model->idResult = $idResult;
        if($model->addEventMembers($request->get('arrOwners'), $request->get('arrRole'), $request->get('arrResults'), $idResult, "edit")){
            return redirect('profile')->with('save', 'Научный результат успешно добавлен');
        }
        else
            return redirect('profile')->with('error', 'Ошибка записи');
    }

    public function showInfoAboutPublication($idPublication){
        $publication = new ScientificPublication($idPublication);
        $members = $publication->getAuthors();
        $arrUser = array();
        $i = 0;
        foreach ($members as $user) {
            $arrUser[$i] = $user->idUsers;
            $i++;
        }
        session()->put('owners', $arrUser);
        return view('panel/resultsPages/infoPub',
            array('title' => 'createrating','description' => '',
                'page' => 'createrating',
                'publication' => $publication->identifyPublication(),
                'members' =>$members ,
                'arrType' => TypeOfRes::getPublicationTypes(),
            )
        );
    }

    public  function editPublicationInfoForm($idPublication, Request $request){
        $model = new EditResults();
        if($model->editPublicationInfoForm($idPublication, $request->get('name'), $request->get('date'),
            $request->get('type'), $request->get('publishing'), $request->get('pages'))

        ){
            return redirect('profile')->with('save', 'Научная публикация успешно обновлена');
        }
        else
            return redirect('profile')->with('error', 'Ошибка записи');
    }

    public function editPubAuthorsForm($idResult, AddOwnersFormRequest $request){
        $model = new AddOwnersForm();
        $model->arrOwners = $request->get('arrOwners');
        $model->arrRole = $request->get('arrRole');
        $model->idResult = $idResult;
        if($model->addPublicationAuthor($request->get('arrOwners'), $request->get('arrRole'), $idResult, "edit")){
            return redirect('profile')->with('save', 'Научная публикация успешно обновлена');
        }
        else
            return redirect('profile')->with('error', 'Ошибка записи');
    }

    public function showRankingsPage(){
        return view('usersPanel/rankingPage',
            array('title' => 'rankingsPage','description' => 'rankingsPage',
                'page' => 'rankingsPage' ));
    }

    public function deleteAuthorOfPublication($idAuthor){
        ScientificPublication::deleteAuthorOfPublication($idAuthor);
        return redirect()->back();
    }

    public function editAuthorOfPublication($idAuthor, Request $request)
    {
        if ($request->ajax()) {
            return view('panel/userRating/editResultPublication',
                array('title' => 'editResultPublication','description' => 'editResultPublication'));
        }

        else
            return view('panel/userRating/editResultPublication',
                array('title' => 'editResultPublication','description' => 'editResultPublication'));

    }

    public function deleteMemberOfEvent($idMember){
        ScientificEvent::deleteMemberOfEvent($idMember);
        return redirect()->back();
    }



}

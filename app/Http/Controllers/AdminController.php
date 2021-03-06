<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleMiddleware;
use App\Http\Requests\MethodistCreatingValidation;
use App\Http\Requests\ProfessorCreatingValidation;
use App\Mail\VerifyMail;
use App\Models\AdminPanel\CreateUserForm;
use App\Models\RankingModels\Rankings;
use App\Models\RankingModels\ScientificPublication;
use App\Models\RankingModels\ScientificResult;
use App\Models\UsersModels\Professor;
use App\Models\UsersModels\Student;
use App\Models\UsersOwners;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
//TODO student status reg
class AdminController extends Controller
{
    public function index() {
        return view('adminPanel/dashboard-lite',
            array('title' => 'profile','description' => '',
                'page' => 'profile',
                'unconfirm_users' => User::getAllUnconfirmedUsers(),
                'new_student' => User::getAllNewStudent(),
                'groups' => Student::getCountOfGroup(),
                'subjects' => Professor::getCountOfSubject(),
                'rankings' => Rankings::getCountOfRankings(),
                'new_pub' => count(ScientificResult::getAllNewPublications()),
                'new_event' => count(ScientificResult::getAllNewEvents()),
                'methodists' => User::all()->where('type', User::METHODIST),
            )
        );
    }

    public function updateAdminPassForm(Request $request){
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
                return redirect(LocaleMiddleware::getLocale().'/admin')->with('save', Lang::get('messages.data_changed_succ'));
            }
            else
                return redirect(LocaleMiddleware::getLocale().'/admin')->with('error', Lang::get('messages.data_changed_err'));
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect(LocaleMiddleware::getLocale().'/admin')->with('error', Lang::get('messages.data_changed_err'));
        } catch (\Exception $e) {
            return redirect(LocaleMiddleware::getLocale().'/admin')->with('error', Lang::get('messages.data_changed_err'));
        }

    }

    public function createMethodistPage(){
            return view('adminPanel/users/methodist/createMethodist');
    }

    public function createMethodistForm(MethodistCreatingValidation $request){
        //with email send
        $model = new CreateUserForm();
        $username = $request->get('username');
        $email =  $request->get('email');
        if ($model->createMethodist($username, $email, $email)){
            $user = User::where('email', '=', $email)->firstOrFail();
            Mail::to($email)->send(new VerifyMail($user));
            return redirect(LocaleMiddleware::getLocale().'/admin');
        }
        else
            return redirect(LocaleMiddleware::getLocale().'/admin')->with('error', Lang::get('messages.err_writing'));
    }

    public function methodistList(){
        return view('adminPanel/users/methodist/listMethodist',
            array(
                'methodists' => User::all()->where('type', User::METHODIST),
            ));
    }

    public function professorList(){
        return view('adminPanel/users/professors/listProfessors',
            array(
                'professors' => UsersOwners::getProf(),
            ));
    }

    public function createProfessorPage(){
        return view('adminPanel/users/professors/createProfessor');
    }

    public function createProfessorForm(ProfessorCreatingValidation $request){
        //with email send
        $model = new CreateUserForm();
        $username = $request->get('username');
        $email =  $request->get('email');
        $surname =  $request->get('surname');
        $name =  $request->get('name');
        $patronymic =  $request->get('patronymic');
        if ($model->createProfessor($username, $email, $email, $name, $surname, $patronymic)){
            $user = User::where('email', '=', $email)->firstOrFail();
            Mail::to($email)->send(new VerifyMail($user));
            return redirect(LocaleMiddleware::getLocale().'/admin');
        }
        else
            return redirect(LocaleMiddleware::getLocale().'/admin')->with('error', Lang::get('messages.err_writing'));
    }

    public function deleteUser($idMethodist){
        User::deleteUserById($idMethodist);
        return redirect()->back();
    }
}

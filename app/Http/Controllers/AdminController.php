<?php

namespace App\Http\Controllers;

use App\Models\AdminPanel\CreateUserForm;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index() {
        return view('adminPanel/dashboard-lite',
            array('title' => 'profile','description' => '',
                'page' => 'profile'));
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
                return redirect('admin')->with('save', 'Данные успешно изменены');
            }
            else
                return redirect('admin')->with('error', 'Ошибка при измении данных');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('admin')->with('error', 'Ошибка при измении данных');
        } catch (\Exception $e) {
            return redirect('admin')->with('error', 'Ошибка при измении данных');
        }

    }

    public function createMethodistPage(){
            return view('adminPanel/users/methodist/createMethodist');
    }

    public function createMethodistForm(Request $request){
        //with email send
        $model = new CreateUserForm();
        $username = $request->get('username');
        $email =  $request->get('email');
        $password =  $request->get('password');
        if ($model->createMethodist($username, $email, $password)){
            return redirect('admin');
        }
        else
            return redirect('admin')->with('error', 'Ошибка записи');
    }

    public function methodistList(){
        return view('adminPanel/users/methodist/listMethodist',
            array(
                'methodists' => User::all()->where('type', User::METHODIST),
            ));
    }
}

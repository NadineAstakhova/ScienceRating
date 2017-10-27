<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function login(Request $request){
        return view('auth/login');
    }

    public function authenticate(Request $request) {
        //if (Auth::attempt(['email' =>$request->get('email'), 'password' => $request->get('password')])) {
        if ($this->getUser($request->get('email'),$request->get('password'))) {
            return redirect()->intended('profile');
        } else {
            return redirect()->back()->withInput()->with('message', 'Ошибка входа! Возможно email и/или пароль не верны');
        }
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect('auth/login');
    }

    private function getUser($email, $pass){

        if("tata@mail.ru" == $email && "1234" == $pass)

            return true;
        else
            return false;

    }
}

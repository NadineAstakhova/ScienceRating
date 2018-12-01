<?php

namespace App\Http\Controllers;

use App\Http\Middleware\LocaleMiddleware;
use App\Mail\DataMail;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function login(Request $request){
        return view('auth/login');
    }

    public function authenticate(Request $request) {
        if (Auth::attempt(['email' =>$request->get('email'), 'password' => $request->get('password'), 'type' => User::METHODIST])) {
       // if ($this->getUser($request->get('email'),$request->get('password'))) {
            return redirect()->intended('profile');
        }
        elseif(Auth::attempt(['email' =>$request->get('email'), 'password' => $request->get('password'), 'type' => User::PROFESSOR])) {
            // if ($this->getUser($request->get('email'),$request->get('password'))) {
            return redirect()->intended('professorProfile');
        }
        elseif(Auth::attempt(['email' =>$request->get('email'), 'password' => $request->get('password'), 'type' => User::STUDENT])) {
            // if ($this->getUser($request->get('email'),$request->get('password'))) {
            return redirect()->intended('studentProfile');
        }
        elseif(Auth::attempt(['email' =>$request->get('email'), 'password' => $request->get('password'), 'type' => User::SUPER_ADMIN])) {
            // if ($this->getUser($request->get('email'),$request->get('password'))) {
            return redirect()->intended('admin');
        }

        else {
            return redirect()->back()->withInput()->with('message', 'Email и/или пароль не верны');
        }
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect(LocaleMiddleware::getLocale().'/auth/login');
    }

    private function getUser($email, $pass){

        if("tata@mail.ru" == $email && "1234" == $pass)

            return true;
        else
            return false;

    }

    public function verifyUser($token){
        $verifyUser = User::where('token', $token)->first();
        if(isset($verifyUser) ){
            if($verifyUser['status'] == 0) {
                $verifyUser['status'] = 1;
                $verifyUser['token'] = null;
                $verifyUser->save();
                $status = "Благодарим за подтверждение. На вашу почту высланы данные для входа";
                Mail::to($verifyUser['email'])->send(new DataMail($verifyUser));
            }else{
                $status = "Ваша почта уже была подтверждена";
            }
        }else{
            return redirect(LocaleMiddleware::getLocale().'/auth/login')->with('message', "Вашей почты нет в базе данных");
        }
        return redirect(LocaleMiddleware::getLocale().'/auth/login')->with('message', $status);
    }

}

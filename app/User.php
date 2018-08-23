<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';

    const PROFESSOR = '1';
    const STUDENT = '2';
    const METHODIST = '3';
    const SUPER__ADMIN = '4';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','type', 'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    protected $primaryKey = 'idUsers';


    public function username()
    {
        return 'username';
    }

    public static function updatePass($id,  $pass){
        $update = DB::table('users')
            ->where('idUsers', $id)
            ->update(['password' =>$pass]);
        if($update)
            return true;
        else
            return false;
    }

    public static function updateUserInfo($id, $email){
        $update = DB::table('users')
            ->where('idUsers', $id)
            ->update(['email' => $email]);
        if($update)
            return true;
        else
            return false;
    }

    public function createMethodist($username, $email, $password){
        $insert = DB::table('users')->insert([
            ['username' => $username, 'email' => $email, 'password' => bcrypt($password), 'type' => self::METHODIST]
        ]);
        if ($insert)
            return true;
        else
            return false;
    }

}

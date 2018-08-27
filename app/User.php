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

    const STATUS = [0 => 'UNCONFIRMED', 1 => 'CONFIRMED'];



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','type', 'remember_token', 'token', 'status', 'updated_at'
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

    public function createUser($username, $email, $password, $type){
        $insert = DB::table('users')->insert([
            ['username' => $username, 'email' => $email, 'password' => bcrypt($password), 'type' => $type,
                'token' =>  bin2hex(random_bytes(32))]
        ]);
        if ($insert)
            return true;
        else
            return false;
    }



}

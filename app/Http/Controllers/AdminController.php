<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
    //TODO design
        return view('adminPanel/adminProfile',
            array('title' => 'profile','description' => '',
                'page' => 'profile'));
    }
}

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Anouar\Fpdf\Fpdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
Route::get('/', 'Controller@login');

Route::get('auth/login', 'Controller@login');
Route::post('auth/login', 'Controller@authenticate');
Route::get('auth/logout', 'Controller@logout');

Route::get('/profile','ProfileController@index');

Route::get('/createres','ProfileController@createResultPage');

Route::post('/createResult', 'ProfileController@createResultForm');

Route::get('/createres/{idRes}','ProfileController@createResultOwner');

Route::post('/addResultOwner/{idRes}', 'ProfileController@createResultOwnerForm');

Route::get('/createrating','ProfileController@createRatingPage');

Route::get('/pdfMaster/{idTemp}', 'ProfileController@createPdfReport');
//Route::get('/pdfMaster', ['as' => 'search', 'uses' => 'ProfileController@createPdfReport']);

/*Route::get('pdfMaster', function(){
    $fpdf = new Fpdf();
    $fpdf->AddPage();
    $fpdf->SetFont('Arial','B',16);
    $fpdf->Cell(40,10,'Hello World!');
    $fpdf->Output();
    exit;

});*/

Route::get('/information/create/ajax-year',function()
{
    $year_id = Input::get('year_id');
    $subcategories = \App\UsersOwners::getGroups($year_id);
    return $subcategories;
});

Route::get('/information/create/ajax-group',function()
{
    $group_id = Input::get('group_id');
    $subcategories = \App\UsersOwners::getStudentsInGroup($group_id);
    return $subcategories;
});

Auth::routes();

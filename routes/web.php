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
use App\Models\UsersOwners;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
Route::get('/', 'Controller@login');

Route::get('auth/login', 'Controller@login');
Route::post('auth/login', 'Controller@authenticate');
Route::get('auth/logout', 'Controller@logout');

Route::get('/profile','ProfileController@index')->middleware('auth');

Route::get('/createArticle','ProfileController@createArticlePage')->middleware('auth');
Route::post('/createPublicationForm', 'ProfileController@createArticleForm')->middleware('auth');
Route::get('/addArticleAuthor/{idRes}','ProfileController@createResultOwner')->middleware('auth');
Route::post('/addPublicationAuthor/{idRes}', 'ProfileController@addPublicationAuthorForm')->middleware('auth');

Route::get('/createResult','ProfileController@createEventPage')->middleware('auth');
Route::post('/createEventForm', 'ProfileController@createEventForm')->middleware('auth');
Route::get('/addEventAuthor/{idRes}','ProfileController@memberOfEventPage')->middleware('auth');
Route::post('/addEventMembers/{idRes}', 'ProfileController@addEventMembersForm')->middleware('auth');



Route::get('/createrating','ProfileController@createRatingPage')->middleware('auth');

Route::get('/results','ProfileController@showUsers')->middleware('auth');

Route::get('/showUserResult', function() {

    $action = "showUserResult";
    return App::make('App\Http\Controllers\ProfileController')->$action(Input::get('owner_id'));
});

//Route::get('/pdfMaster/{idTemp}', 'ProfileController@createPdfReport')->middleware('auth');

Route::get('/pdfMaster/{idTemp}', function($idTemp) {
    $action = "";
    if(Input::get('pdf'))
        $action = 'createPdfReport';
    elseif(Input::get('doc'))
        $action = 'createDocReport';
    return App::make('App\Http\Controllers\ProfileController')->$action($idTemp, Input::get('owner_id'));
});
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
    $subcategories = UsersOwners::getGroups($year_id);
    return $subcategories;
});

Route::get('/information/create/ajax-group',function()
{
    $group_id = Input::get('group_id');
    $subcategories = UsersOwners::getStudentsInGroup($group_id);
    return $subcategories;
});


Route::get('/information/res/{id}',function()
{
    $year_id = Route::get('id');
    return $year_id;
});


Route::get('/articles/{id}', 'ProfileController@showArticles')->name('articles');
Route::resource('/articles', 'ProfileController@showArticles');

Route::get('/professorProfile','ProfileController@professorProfile')->middleware('auth');
Route::get('/infoProfile','ProfileController@infoProfile')->middleware('auth');
Route::post('/editProfInfo', 'ProfileController@updateUserInfoForm')->middleware('auth');

Route::get('/studentProfile','ProfileController@studentProfile')->middleware('auth');
Route::post('/editStudentInfo', 'ProfileController@updateStudentInfoForm')->middleware('auth');

Route::get('/infoProfileMethodist','ProfileController@infoProfile')->middleware('auth');
Route::post('/editMethodistInfo', 'ProfileController@updateMethodistInfoForm')->middleware('auth');

Route::get('/acceptResults','ProfileController@acceptResultsPage')->middleware('auth');
Route::post('/changeStatusForNewRes', 'ProfileController@changeStatusForNewResForm')->middleware('auth');

Route::get('/event/{id}','ProfileController@showInfoAboutResult')->middleware('auth');
Route::post('/editEventInfo/{id}', 'ProfileController@editEventInfoForm')->middleware('auth');
Route::get('/editEventMembers/{idRes}','ProfileController@memberOfEventPage')->middleware('auth');
Route::post('/editEventMembersForm/{idRes}', 'ProfileController@editEventMembersForm')->middleware('auth');

Route::get('/publication/{id}','ProfileController@showInfoAboutPublication')->middleware('auth');
Route::post('/editPublicationInfo/{id}', 'ProfileController@editPublicationInfoForm')->middleware('auth');
Route::get('/editAuthorMembers/{idRes}','ProfileController@createResultOwner')->middleware('auth');
Route::post('/editAuthorMembersForm/{idRes}', 'ProfileController@editPubAuthorsForm')->middleware('auth');

Route::get('/showUserResult/{id}','ProfileController@showUserResult')->middleware('auth');

Route::get('/createArticleByUser/{idUser}','ProfileController@createArticlePage')->middleware('auth');
Route::post('/createPublicationForm/{idUser}', 'ProfileController@createArticleForm')->middleware('auth');

Route::get('/createEventByUser/{idUser}','ProfileController@createEventPage')->middleware('auth');
Route::post('/createEventForm/{idUser}', 'ProfileController@createEventForm')->middleware('auth');

Route::get('/rankingsPage','ProfileController@showRankingsPage')->middleware('auth');

//TODO: add normal identify for rankings
Route::get('/pdfRanking/{idTemp}/{idUser}','ProfileController@createPdfReport')->middleware('auth');
Route::get('/docRanking/{idTemp}/{idUser}','ProfileController@createDocReport')->middleware('auth');

Route::get('/deleteAuthorPub/{idAuthor}','ProfileController@deleteAuthorOfPublication')->middleware('auth');
//TODO
Route::get('/editAuthorPub/{idAuthor}','ProfileController@editAuthorOfPublication')->middleware('auth');

Route::get('/deleteMemberEvent/{idMember}','ProfileController@deleteMemberOfEvent')->middleware('auth');

Route::post('/editPercent', 'ProfileController@editPercentToUser')->middleware('auth');
Route::post('/editResult', 'ProfileController@editResultToUser')->middleware('auth');
Route::post('/editRole', 'ProfileController@editRoleToUser')->middleware('auth');

Route::get('/admin','AdminController@index')->middleware('auth');
Route::get('/infoAdminMethodist','ProfileController@infoProfile')->middleware('auth');
Route::post('/editAdminInfo', 'AdminController@updateAdminPassForm')->middleware('auth');

Route::get('/createMethodistPage','AdminController@createMethodistPage')->middleware('auth');
Route::post('/createMethodistForm', 'AdminController@createMethodistForm')->middleware('auth');

Route::get('/methodistList','AdminController@methodistList')->middleware('auth');

Auth::routes();

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

Route::get('/pdfMaster/{idTemp}/{idOwner}', 'ProfileController@createPdfReport');

/*Route::get('pdfMaster', function(){
    $fpdf = new Fpdf();
    $fpdf->AddPage();
    $fpdf->SetFont('Arial','B',16);
    $fpdf->Cell(40,10,'Hello World!');
    $fpdf->Output();
    exit;

});*/

Auth::routes();

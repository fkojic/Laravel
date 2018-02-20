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

Auth::routes();

Route::get('/', 'AutomobiliController@index');

Route::post('/home', 'AutomobiliController@index');
Route::post('/createA', 'AutomobiliController@store');

Route::post('/login/custom',[
	'uses' => 'HomeController@login',
	'as' => 'login.custom'
]);

Route::group(['middleware' => 'auth'], function(){
	Route::get('/home', 'AutomobiliController@index')->name('home');

	Route::get('/dashboard', 'AdminController@index')->name('dashboard');
});

Route::resource('/automobili', 'AutomobiliController');

Route::get('/createKategoriju', 'AdminController@createKategoriju');
Route::get('/kategorije', ['as'=> 'kategorije', 'uses'=>'AutomobiliController@kategorije']);
Route::get('/storeKategoriju', 'AdminController@storeKategoriju');
Route::get('/destroyKategoriju', ['as'=> 'destroyKategoriju', 'uses'=> 'AdminController@destroyKategoriju']);
Route::get('/pushKategoriju', ['as'=> 'pushKategoriju', 'uses'=> 'AdminController@pushKategoriju']);
Route::get('/adminAutomobili', ['as'=> 'adminAutomobili', 'uses'=> 'AdminController@adminAutomobili']);

Route::get('/create', ['as'=> 'create', 'uses'=>'AdminController@store']);
Route::get('/update', ['as'=> 'update', 'uses'=>'AdminController@update']);
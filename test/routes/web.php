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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/{username}/update', 'UserController@edit');
Route::post('user/update/{username}', 'UserController@update')->name('user.update');
Route::get('/create', 'UserController@create');
Route::prefix('user')->group(function (){
    Route::get('/create', 'UserController@create');
});

Route::get('/user/{username}/avatar', 'UserController@upAvatar');

Route::put('/user/{username}', 'UserController@index');
Route::get('/user/{username}/show', 'UserController@show');
Route::resource('/user', 'UserController');
Route::resource('/', 'UserController');

Route::get('user/avatar-upload',['as'=>'avatar.upload','uses'=>'UserController@upAvatar']);
Route::post('user/avatar-upload/{username}',['as'=>'avatar.upload.post','uses'=>'UserController@saveAvatar']);

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

Route::get('/create', 'UserController@create');
Route::prefix('user')->group(function (){
    Route::get('/user/{username}', 'UserController@index');
    Route::get('/create', 'UserController@create');
    Route::get('/{username}/update', 'UserController@edit');
    Route::get('/{username}/delete', 'UserController@delete');
    Route::get('/{username}/avatar', 'UserController@upAvatar');
    Route::get('/{username}/show', 'UserController@show');
    Route::get('/avatar-upload',['as'=>'avatar.upload','uses'=>'UserController@upAvatar']);
    Route::post('/avatar-upload/{username}',['as'=>'avatar.upload.post','uses'=>'UserController@saveAvatar']);
});

Route::resource('/', 'UserController');
Route::resource('/user', 'UserController');



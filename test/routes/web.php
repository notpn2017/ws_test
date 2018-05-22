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

Route::get('/create', 'API\UserRegisterController@create');
Route::prefix('user')->group(function (){
    Route::get('/user/{username}', 'API\UserRegisterController@index');
    Route::get('/create', 'API\UserRegisterController@create');
    Route::get('/{username}/update', 'API\UserRegisterController@edit');
    Route::get('/{username}/delete', 'API\UserRegisterController@delete');
    Route::get('/{username}/avatar', 'API\UserRegisterController@upAvatar');
    Route::get('/{username}/show', 'API\UserRegisterController@show');
    Route::get('/avatar-upload',['as'=>'avatar.upload','uses'=>'API\UserRegisterController@upAvatar']);
    Route::post('/avatar-upload/{username}',['as'=>'avatar.upload.post','uses'=>'API\UserRegisterController@saveAvatar']);
});

Route::resource('/', 'API\UserRegisterController');
Route::resource('/user', 'API\UserRegisterController');



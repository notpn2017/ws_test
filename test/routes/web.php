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

Route::get('/create', 'API\UserController@create');
Route::prefix('user')->group(function (){
    Route::get('/user/{username}', 'API\UserController@index');
    Route::get('/create', 'API\UserController@create');
    Route::get('/{username}/update', 'API\UserController@edit');
    Route::get('/{username}/delete', 'API\UserController@delete');
    Route::get('/{username}/avatar', 'API\UserController@upAvatar');
    Route::get('/{username}/view', 'API\UserController@view');
    Route::post('/{username}/show', 'API\UserController@show');
    Route::get('/avatar-upload',['as'=>'avatar.upload','uses'=>'API\UserController@upAvatar']);
    Route::post('/avatar-upload/{username}',['as'=>'avatar.upload.post','uses'=>'API\UserController@saveAvatar']);
});

Route::resource('/', 'API\UserController');
Route::resource('/user', 'API\UserController');



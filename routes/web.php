<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::resource('novelgroups', 'NovelGroupController');
Route::resource('novels', 'NovelController');


Route::get('/author/index', 'PageController\AuthorPageController@index');
Route::get('/author/create', 'PageController\AuthorPageController@create');
Route::get('/author/{id}/edit', 'PageController\AuthorPageController@edit');
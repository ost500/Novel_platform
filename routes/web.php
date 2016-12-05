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

//Route::get('/home', 'HomeController@index');
Route::resource('novelgroups', 'NovelGroupController');
Route::get('novelgroup/novels/{id}', ['as' => 'novelgroup.novel', 'uses' => 'NovelGroupController@show_novel']);
Route::get('novelgroup/novels/inning/{id}', ['as' => 'novelgroup.inning', 'uses' => 'NovelGroupController@inning_order']);
Route::resource('novels', 'NovelController');
Route::resource('comments', 'CommentController');
Route::resource('mentomen', 'MenToMenQuestionAnswerController');
Route::resource('faqs', 'FaqController');
Route::resource('users', 'UserController', ['except' => ['update']]);
Route::put('users/update', ['as' => 'users.update', 'uses' => 'UserController@update']);
Route::resource('nickname', 'NickNameController');


Route::get('/author/create', ['as' => 'author.create', 'uses' => 'PageController\AuthorPageController@create']);
Route::get('/author/{id}/edit', 'PageController\AuthorPageController@edit');

Route::get('/author/index', ['as' => 'author_index', 'uses' => 'PageController\AuthorPageController@index']);
Route::get('/author/novelgroup/{id}', ['as' => 'author_novel_group', 'uses' => 'PageController\AuthorPageController@novel_gorup']);
Route::get('/author/profile/', ['as' => 'author.profile', 'uses' => 'PageController\AuthorPageController@profile']);
Route::get('/author/nickname/', ['as' => 'author.nickname', 'uses' => 'PageController\AuthorPageController@nickname']);
Route::get('/author/create_inning/{id}', ['as' => 'author.inning', 'uses' => 'PageController\AuthorPageController@create_inning']);
Route::get('/author/update_inning/{id}', ['as' => 'author.inning.update', 'uses' => 'PageController\AuthorPageController@update_inning']);
Route::get('/author/mycomment/{id}', ['as' => 'author.mycomment', 'uses' => 'PageController\AuthorPageController@mycomment']);

Route::get('/author/create', ['as' => 'author.novel_group_create', 'uses' => 'PageController\AuthorPageController@create']);
Route::get('/author/{id}/edit', ['as' => 'author.novel_group_edit', 'uses' => 'PageController\AuthorPageController@edit']);
Route::get('/author/novel_memo', ['as' => 'author.novel_memo', 'uses' => 'PageController\AuthorPageController@mailbox_index']);
Route::get('/author/mailbox_message/{id}',['as' => 'author.mailbox_message', 'uses' => 'PageController\AuthorPageController@mailbox_message_show']);

Route::get('/author/novel_request', ['as' => 'author.novel_request', 'uses' => 'PageController\AuthorPageController@men_to_men_create']);
Route::get('/author/novel_request_list', ['as' => 'author.novel_request_list', 'uses' => 'PageController\AuthorPageController@men_to_men_index']);
Route::get('/author/novel_request_view/{id}',['as' => 'author.novel_request_view', 'uses' => 'PageController\AuthorPageController@men_to_men_show']);

Route::get('/author/novel_faq', ['as' => 'author.novel_faq', 'uses' => 'PageController\AuthorPageController@faq_index']);
Route::get('/author/faq_create',['as' => 'author.faq_create', 'uses' => 'PageController\AuthorPageController@faq_create']);
Route::get('/author/faq_edit', ['as' => 'author.faq_edit', 'uses' => 'PageController\AuthorPageController@faq_edit']);


Route::get('/admin/index',['as' => 'admin.novel', 'uses' => 'PageController\AdminPageController@index']);
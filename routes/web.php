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
Route::get('novelgroup/{id}/comments', ['as' => 'novelgroup.comments', 'uses' => 'NovelGroupController@show_comments']);
Route::resource('novels', 'NovelController');
Route::put('novels/update_agreement/{id}', ['as' => 'novels.update_agreement', 'uses' => 'NovelController@update_agreement']);
Route::resource('reviews', 'ReviewController');
Route::resource('comments', 'CommentController');
Route::resource('mentomen', 'MenToMenQuestionAnswerController');
Route::resource('faqs', 'FaqController');

Route::resource('users', 'UserController', ['except' => ['update']]);
Route::put('users/update', ['as' => 'users.update', 'uses' => 'UserController@update']);
Route::put('users/update_agreement', ['as' => 'users.update_agreement', 'uses' => 'UserController@update_agreement']);

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
Route::get('/author/novel_memo_send', ['as' => 'author.novel_memo_send', 'uses' => 'PageController\AuthorPageController@mailbox_send']);
Route::get('/author/novel_memo_create', ['as' => 'author.novel_memo_create', 'uses' => 'PageController\AuthorPageController@mailbox_create']);
Route::get('/author/mailbox_message/{id}',['as' => 'author.mailbox_message', 'uses' => 'PageController\AuthorPageController@mailbox_message_show']);

Route::get('/author/novel_request', ['as' => 'author.novel_request', 'uses' => 'PageController\AuthorPageController@men_to_men_create']);
Route::get('/author/novel_request_list', ['as' => 'author.novel_request_list', 'uses' => 'PageController\AuthorPageController@men_to_men_index']);
Route::get('/author/novel_request_view/{id}',['as' => 'author.novel_request_view', 'uses' => 'PageController\AuthorPageController@men_to_men_show']);

Route::get('/author/novel_faq', ['as' => 'author.novel_faq', 'uses' => 'PageController\AuthorPageController@faq_index']);
Route::get('/author/faq_create',['as' => 'author.faq_create', 'uses' => 'PageController\AuthorPageController@faq_create']);
Route::get('/author/faq_edit', ['as' => 'author.faq_edit', 'uses' => 'PageController\AuthorPageController@faq_edit']);


Route::get('/admin/index',['as' => 'admin.index', 'uses' => 'PageController\AdminPageController@index']);
Route::get('/admin/novel',['as' => 'admin.novel', 'uses' => 'PageController\AdminPageController@novel']);
Route::get('/admin/novel_json',['as' => 'admin.novel_json', 'uses' => 'PageController\AdminPageController@novel_json']);
Route::get('/admin/novel/{id}', ['as' => 'admin.novel_inning', 'uses' => 'PageController\AdminPageController@novel_inning']);
Route::get('/admin/novel/inning/{id}', ['as' => 'admin.novel_inning_view', 'uses' => 'PageController\AdminPageController@novel_inning_view']);

Route::get('/admin/user',['as' => 'admin.user', 'uses' => 'PageController\AdminPageController@user']);
Route::get('/admin/user/{id}',['as' => 'admin.profile', 'uses' => 'PageController\AdminPageController@profile']);
Route::get('/admin/sales',['as' => 'admin.sales', 'uses' => 'PageController\AdminPageController@sales']);
Route::get('/admin/request',['as' => 'admin.request', 'uses' => 'PageController\AdminPageController@request']);
Route::get('/admin/request/{id}',['as' => 'admin.request_view', 'uses' => 'PageController\AdminPageController@request_view']);
Route::post('/admin/request/{id}/answer',['as' => 'admin.request_answer', 'uses' => 'MenToMenQuestionAnswerController@answer']);
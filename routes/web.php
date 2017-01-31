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


Auth::routes();

//Route::get('/home', 'HomeController@index');
Route::resource('novelgroups', 'NovelGroupController');
Route::get('novelgroup/novels/{id}', ['as' => 'novelgroup.novel', 'uses' => 'NovelGroupController@show_novel']);
Route::get('novelgroup/novels/inning/{id}', ['as' => 'novelgroup.inning', 'uses' => 'NovelGroupController@inning_order']);
Route::get('novelgroup/{id}/comments', ['as' => 'novelgroup.comments', 'uses' => 'NovelGroupController@show_comments']);
Route::put('novelgroup/secret/{id}', ['as' => 'novelgroup.secret', 'uses' => 'NovelGroupController@secret']);
Route::put('novelgroup/non_secret/{id}', ['as' => 'novelgroup.non_secret', 'uses' => 'NovelGroupController@non_secret']);
Route::post('novelgroup/clone_for_publish/{id}', ['as' => 'novelgroup.clone_for_publish', 'uses' => 'NovelGroupController@clone_for_publish']);
Route::resource('novels', 'NovelController');
Route::put('novels/update_agreement/{id}', ['as' => 'novels.update_agreement', 'uses' => 'NovelController@update_agreement']);
Route::put('novels/make_adult/{id}', ['as' => 'novels.make_adult', 'uses' => 'NovelController@make_adult']);
Route::put('novels/cancel_adult/{id}', ['as' => 'novels.cancel_adult', 'uses' => 'NovelController@cancel_adult']);
Route::resource('reviews', 'ReviewController');
Route::resource('comments', 'CommentController');
Route::resource('mentomen', 'MenToMenQuestionAnswerController');
Route::resource('faqs', 'FaqController');
Route::resource('favorites', 'FavoriteController', ['only' => ['store', 'destroy']]);
Route::resource('keywords', 'KeywordController');
Route::resource('companies', 'CompanyController');
Route::resource('publish_companies', 'NovelGroupPublishCompanyController', ['only' => ['update']]);
Route::delete('maillogs/{id}', ['as' => 'maillog.destroy', 'uses' => 'MailLogController@destroy']);
Route::put('maillogs', ['as' => 'maillog.update', 'uses' => 'MailLogController@update']);
Route::put('publish_novel/{id}', ['as' => 'publish_novel.update', 'uses' => 'PublishNovelController@update']);
Route::post('publish_novel', ['as' => 'publish_novel.store', 'uses' => "PublishNovelController@store"]);
Route::post('publish_novel/update_status', ['as' => 'publish_novel.update_status', 'uses' => "PublishNovelController@update_status"]);
Route::delete('publish_novel/{id}', ['as' => 'publish_novel.destroy', 'uses' => "PublishNovelController@destroy"]);
Route::get('publish_novel/e_pub/{id}', ['as' => 'publish_novel.e_pub', 'uses' => "PublishNovelController@e_pub"]);


Route::resource('users', 'UserController', ['except' => ['update']]);
Route::post('mailboxes', ['as' => 'mailbox.store', 'uses' => 'MailboxController@store']);
Route::post('mailboxes/specific_mail', ['as' => 'mailbox.store_specific_mail', 'uses' => 'MailboxController@store_specific_mail']);
Route::post('mailboxes/destroy', ['as' => 'mailbox.destroy', 'uses' => 'MailboxController@destroy']);
Route::delete('mailboxes/destroy_sent/{id}', ['as' => 'mailbox.destroy_sent', 'uses' => 'MailboxController@destroy_sent']);
Route::post('mailboxes/destroy_sent_bulk', ['as' => 'mailbox.destroy_sent_bulk', 'uses' => 'MailboxController@destroy_sent_bulk']);

Route::put('users/update', ['as' => 'users.update', 'uses' => 'UserController@update']);
Route::put('users/update_agreement', ['as' => 'users.update_agreement', 'uses' => 'UserController@update_agreement']);

Route::resource('nickname', 'NickNameController');

Route::post('publishnovelgroups', ['as' => 'publishnovelgroups.store', 'uses' => "PublishNovelGroupController@store"]);
Route::put('publishnovelgroups/{novel_group_publish_company_id}', ['as' => 'publishnovelgroups.apply_each_company', 'uses' => "PublishNovelGroupController@apply_each_company"]);
Route::get('publishnovelgroups/', ['as' => 'publishnovelgroups.show_novels', 'uses' => "PublishNovelGroupController@show_novels"]);
Route::post('publishnovelgroups/today_done', ['as' => 'publishnovelgroups.today_done', 'uses' => "PublishNovelGroupController@today_done"]);
Route::post('publishnovelgroups/stop', ['as' => 'publishnovelgroups.stop', 'uses' => "PublishNovelGroupController@stop"]);
Route::get('publishnovelgroups/search_by_group/{search}', ['as' => 'publishnovelgroups.search_by_group', 'uses' => "PublishNovelGroupController@search_by_group"]);
//Route::get('/author/create', ['as' => 'author.create', 'uses' => 'PageController\AuthorPageController@create']);
//Route::get('/author/{id}/edit', 'PageController\AuthorPageController@edit');

Route::get('/author/profile/information', ['as' => 'author.profile', 'uses' => 'PageController\AuthorPageController@profile']);
Route::get('/author/profile/nickname/', ['as' => 'author.nickname', 'uses' => 'PageController\AuthorPageController@nickname']);

Route::get('/author/index', ['as' => 'author.index', 'uses' => 'PageController\AuthorPageController@index']);
Route::get('/author/management/novelgroups', ['as' => 'author_index', 'uses' => 'PageController\AuthorPageController@index']);
Route::get('/author/management/novelgroups/create', ['as' => 'author.novel_group_create', 'uses' => 'PageController\AuthorPageController@create']);
Route::get('/author/management/novelgroups/{id}', ['as' => 'author_novel_group', 'uses' => 'PageController\AuthorPageController@novel_gorup']);
Route::get('/author/management/novelgroups/{id}/edit', ['as' => 'author.novel_group_edit', 'uses' => 'PageController\AuthorPageController@edit']);

Route::get('/author/management/create_novel/{id}', ['as' => 'author.inning', 'uses' => 'PageController\AuthorPageController@create_inning']);
Route::get('/author/management/update_novel/{id}', ['as' => 'author.inning.update', 'uses' => 'PageController\AuthorPageController@update_inning']);
Route::get('/author/management/show_novel/{id}', ['as' => 'author.show_inning', 'uses' => 'PageController\AuthorPageController@show_inning']);
Route::get('/author/mycomment/{id}', ['as' => 'author.mycomment', 'uses' => 'PageController\AuthorPageController@mycomment']);

Route::get('/author/mailbox/receive_mail', ['as' => 'author.novel_memo', 'uses' => 'PageController\AuthorPageController@mailbox_index']);
Route::get('/author/mailbox/receive_mail/{id}', ['as' => 'author.mailbox_message', 'uses' => 'PageController\AuthorPageController@mailbox_message_show']);
Route::get('/author/mailbox/sent_mail', ['as' => 'author.novel_memo_send', 'uses' => 'PageController\AuthorPageController@mailbox_send']);
Route::get('/author/mailbox/sent_mail/{id}', ['as' => 'author.mailbox_send_message', 'uses' => 'PageController\AuthorPageController@mailbox_send_message_show']);
Route::get('/author/mailbox/create_mail', ['as' => 'author.novel_memo_create', 'uses' => 'PageController\AuthorPageController@mailbox_create']);
Route::get('/author/mailbox/specific_mail/{id?}', ['as' => 'author.specific_mail', 'uses' => 'PageController\AuthorPageController@specific_mailbox_create']);

Route::get('/author/men_to_men/request_create', ['as' => 'author.novel_request', 'uses' => 'PageController\AuthorPageController@men_to_men_create']);
Route::get('/author/men_to_men/requests', ['as' => 'author.novel_request_list', 'uses' => 'PageController\AuthorPageController@men_to_men_index']);
Route::get('/author/men_to_men/requests/{id}', ['as' => 'author.novel_request_view', 'uses' => 'PageController\AuthorPageController@men_to_men_show']);


Route::get('/author/novel_faq', ['as' => 'author.novel_faq', 'uses' => 'PageController\AuthorPageController@faq_index']);

Route::get('/author/partnership/apply', ['as' => 'author.partner_apply', 'uses' => 'PageController\AuthorPageController@partner_apply']);
Route::get('/author/partnership/apply/proper_company', ['as' => 'author.partner_apply.proper_company', 'uses' => 'PageController\AuthorPageController@partner_apply_proper_company']);
Route::get('/author/partnership/apply_list', ['as' => 'author.partner_apply_list', 'uses' => 'PageController\AuthorPageController@partner_apply_list']);
Route::get('/author/partnership/proceed/', ['as' => 'author.partner_proceed', 'uses' => 'PageController\AuthorPageController@partner_proceed']);
Route::get('/author/partnership/test_inning/{id?}', ['as' => 'author.partner_test_inning', 'uses' => 'PageController\AuthorPageController@partner_test_inning']);

Route::get('/author/faqs', ['as' => 'author.faqs', 'uses' => 'PageController\AuthorPageController@faq_index']);
Route::get('/admin/faqs', ['as' => 'admin.faqs', 'uses' => 'PageController\AdminPageController@faq_index']);
Route::get('/admin/faqs/create', ['as' => 'admin.faqs.create', 'uses' => 'PageController\AdminPageController@faq_create']);
Route::get('/admin/faqs/{id}/edit', ['as' => 'admin.faqs.edit', 'uses' => 'PageController\AdminPageController@faq_edit']);

Route::get('/admin/keywords', ['as' => 'admin.keywords', 'uses' => 'PageController\AdminPageController@keyword_index']);
Route::get('/admin/keywords/create', ['as' => 'admin.keywords.create', 'uses' => 'PageController\AdminPageController@keyword_create']);


Route::get('/admin/index', ['as' => 'admin.index', 'uses' => 'PageController\AdminPageController@index']);
Route::get('/admin/novel', ['as' => 'admin.novel', 'uses' => 'PageController\AdminPageController@index']);
Route::get('/admin/novel/{id}', ['as' => 'admin.novel_inning', 'uses' => 'PageController\AdminPageController@novel_inning']);
Route::get('/admin/novel/inning/{id}', ['as' => 'admin.novel_inning_view', 'uses' => 'PageController\AdminPageController@novel_inning_view']);

Route::get('/admin/users', ['as' => 'admin.users', 'uses' => 'PageController\AdminPageController@users']);
Route::get('/admin/user/{id}', ['as' => 'admin.profile', 'uses' => 'PageController\AdminPageController@profile']);
Route::get('/admin/sales', ['as' => 'admin.sales', 'uses' => 'PageController\AdminPageController@sales']);
Route::get('/admin/request', ['as' => 'admin.request', 'uses' => 'PageController\AdminPageController@request']);
Route::get('/admin/request/{id}', ['as' => 'admin.request_view', 'uses' => 'PageController\AdminPageController@request_view']);
Route::post('/admin/request/{id}/answer', ['as' => 'admin.request_answer', 'uses' => 'MenToMenQuestionAnswerController@answer']);

Route::get('/admin/memo', ['as' => 'admin.memo', 'uses' => 'PageController\AdminPageController@memo']);
Route::get('/admin/memo_detail/{id}', ['as' => 'admin.memo_view', 'uses' => 'PageController\AdminPageController@memo_view']);
Route::get('/admin/memo_create', ['as' => 'admin.memo_create', 'uses' => 'PageController\AdminPageController@memo_create']);
Route::get('/admin/novel_memo_send', ['as' => 'admin.novel_memo_send', 'uses' => 'PageController\AdminPageController@mailbox_send']);
Route::get('/admin/mailbox_send_message/{id}', ['as' => 'admin.mailbox_send_message', 'uses' => 'PageController\AdminPageController@mailbox_send_message_show']);
Route::get('/admin/specific_mail/{id?}', ['as' => 'admin.memo_create', 'uses' => 'PageController\AdminPageController@memo_create']);

Route::get('/admin/partnership/manage_company', ['as' => 'admin.partner_manage_company', 'uses' => 'PageController\AdminPageController@partner_manage_company']);
Route::get('/admin/partnership/manage_apply/{id?}', ['as' => 'admin.partner_manage_apply', 'uses' => 'PageController\AdminPageController@partner_manage_apply']);
Route::get('/admin/partnership/create_company', ['as' => 'admin.partner_create_company', 'uses' => 'PageController\AdminPageController@partner_create_company']);
Route::get('/admin/partnership/edit_company/{id}', ['as' => 'admin.partner_edit_company', 'uses' => 'PageController\AdminPageController@partner_edit_company']);
Route::get('/admin/partnership/test_inning/{id?}', ['as' => 'admin.partner_test_inning', 'uses' => 'PageController\AdminPageController@partner_test_inning']);
Route::get('/admin/partnership/approve_inning/{id?}', ['as' => 'admin.partner_approve_inning', 'uses' => 'PageController\AdminPageController@partner_approve_inning']);


//main
Route::get('/', ['as' => 'root', 'uses' => 'MainController\MainController@main']);

//Series
Route::get('/series/{free_or_charged?}', ['as' => 'series', 'uses' => 'MainController\MainController@series']);
//Bests
Route::get('/bests/{free_or_charged?}', ['as' => 'bests', 'uses' => 'MainController\MainController@bests']);
//completed
Route::get('/completed/{free_or_charged?}', ['as' => 'completed', 'uses' => 'MainController\MainController@completed']);


//Community
Route::group(['prefix' => 'community'], function () {
    Route::get('freeboard', ['as' => 'free_board', 'uses' => 'MainController\CommunityController@free_board']);
    Route::get('freeboard/{id}', ['as' => 'free_board.detail', 'uses' => 'MainController\CommunityController@free_board_detail']);
    // same url diffrent request for the redirection after login
    Route::post('freeboard/{id}', ['as' => 'freeboard.comment', 'middleware' => 'auth', 'uses' => 'FreeBoardCommentController@store']);
    Route::get('freeboard_write', ['middleware'=>'auth','as' => 'free_board.write', 'uses' => 'MainController\CommunityController@free_board_write']);
    Route::post('freeboard/', ['as' => 'free_board.store', 'uses' => 'FreeBoardController@store']);

    Route::get('reader_reco', ['as' => 'reader_reco', 'uses' => 'MainController\CommunityController@reader_reco']);
    Route::get('reader_reco/{id}', ['as' => 'reader_reco.detail', 'uses' => 'MainController\CommunityController@reader_reco_detail']);
    Route::post('reader_reco/{id}', ['as' => 'reader_reco.comment', 'middleware' => 'auth', 'uses' => 'ReviewCommentController@store']);

});

//EachController
Route::get('/novel_group/{id}', ['as' => 'each_novel.novel_group', 'uses' => 'MainController\EachController@novel_group']);
Route::get('novel_group/review/{id}', ['middleware'=>'auth','as' => 'each_novel.novel_group.review', 'uses' => 'MainController\EachController@novel_group_review']);
Route::get('/novel_group_inning/{id}', ['as' => 'each_novel.novel_group_inning', 'uses' => 'MainController\EachController@novel_group_inning']);

//AskController
Route::get('/frequently_asked_questions', ['as' => 'ask.faqs', 'uses' => 'MainController\AskController@faqs']);
Route::get('/questions', ['as' => 'ask.questions', 'uses' => 'MainController\AskController@questions']);
Route::get('/ask_question', ['as' => 'ask.ask_question', 'uses' => 'MainController\AskController@ask_question']);
Route::get('/notifications', ['as' => 'ask.notifications', 'uses' => 'MainController\AskController@notifications']);

//my information
Route::group(['prefix' => 'my_info', 'middleware' => ['auth']], function () {
    //MyPageController
    Route::get('/', ['as' => 'my_page.index', 'uses' => 'MainController\MyPageController@index']);
    Route::get('/favorites', ['as' => 'my_page.favorites', 'uses' => 'MainController\MyPageController@favorites']);
    Route::get('/novels/new_novels', ['as' => 'my_page.novels.new_novels', 'uses' => 'MainController\MyPageController@new_novels']);

    Route::group(['prefix' => 'personal'], function () {
        Route::get('/post_manage', ['as' => 'my_info.post_manage', 'uses' => 'MainController\MyInfoController@post_manage']);
        Route::get('/password_again', ['as' => 'my_info.password_again', 'uses' => 'MainController\MyInfoController@password_again']);
        Route::post('/password_again', ['as' => 'my_info.password_again.post', 'uses' => 'MainController\MyInfoController@password_again_post']);
        Route::get('/edit', ['as' => 'my_info.edit', 'uses' => 'MainController\MyInfoController@edit']);
        Route::post('/edit', ['as' => 'my_info.edit.post', 'uses' => 'UserController@my_info_update']);
        Route::get('/member_leave/password_again', ['as' => 'my_info.member_leave.password_again', 'uses' => 'MainController\MyInfoController@member_leave_password_again']);
        Route::post('/member_leave', ['as' => 'my_info.member_leave', 'uses' => 'UserController@member_leave']);
    });
});

//Mails Controller
Route::group(['prefix' => 'mails', 'middleware' => ['auth']], function () {
    Route::get('/received', ['as' => 'mails.received', 'uses' => 'MainController\MailController@received']);
    Route::get('/sent', ['as' => 'mails.sent', 'uses' => 'MainController\MailController@sent']);
    Route::get('/spam', ['as' => 'mails.spam', 'uses' => 'MainController\MailController@spam']);
    Route::get('/my_box', ['as' => 'mails.my_box', 'uses' => 'MainController\MailController@my_box']);
});

//Mails Controller
Route::group(['prefix' => 'search'], function () {
    Route::post('/', ['as' => 'search.index', 'uses' => 'MainController\SearchController@index']);
    Route::get('/', ['as' => 'search', 'uses' => 'MainController\SearchController@index']);
});
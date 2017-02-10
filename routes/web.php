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
Route::get('id_search', ['as' => 'id_search', 'uses' => 'Auth\IdSearchController@id_search']);
Route::post('id_search', ['as' => 'id_search_post', 'uses' => 'Auth\IdSearchController@id_search_post']);

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
Route::resource('presents', 'PresentController', ['only' => ['update']]);
Route::delete('maillogs/{id}', ['as' => 'maillog.destroy', 'uses' => 'MailLogController@destroy']);
Route::put('maillogs', ['as' => 'maillog.update', 'uses' => 'MailLogController@update']);
Route::put('publish_novel/{id}', ['as' => 'publish_novel.update', 'uses' => 'PublishNovelController@update']);
Route::post('publish_novel', ['as' => 'publish_novel.store', 'uses' => "PublishNovelController@store"]);
Route::post('publish_novel/update_status', ['as' => 'publish_novel.update_status', 'uses' => "PublishNovelController@update_status"]);
Route::delete('publish_novel/{id}', ['as' => 'publish_novel.destroy', 'uses' => "PublishNovelController@destroy"]);
Route::get('publish_novel/e_pub/{id}', ['as' => 'publish_novel.e_pub', 'uses' => "PublishNovelController@e_pub"]);
//newspeed api
Route::get('newspeed/', ['as' => 'newspeed', 'uses' => "NewSpeedController@show"]);
//new mail api
Route::get('newmail/', ['as' => 'newmail', 'uses' => "MailLogController@show"]);


Route::resource('users', 'UserController', ['except' => ['update']]);
//email authentication
Route::post('email_confirm/again', ['as' => 'email_confirm.again', 'uses' => 'UserController@again']);
Route::get('email_confirm/{confirmation_code}/{user_id}', ['as' => 'email_confirm', 'uses' => 'UserController@confirm']);

Route::post('mailboxes', ['as' => 'mailbox.store', 'uses' => 'MailboxController@store']);
Route::post('mailboxes/specific_mail', ['as' => 'mailbox.store_specific_mail', 'uses' => 'MailboxController@store_specific_mail']);
Route::post('mailboxes/destroy', ['as' => 'mailbox.destroy', 'uses' => 'MailboxController@destroy']);
Route::delete('mailboxes/destroy_sent/{id}', ['as' => 'mailbox.destroy_sent', 'uses' => 'MailboxController@destroy_sent']);
Route::post('mailboxes/destroy_sent_bulk', ['as' => 'mailbox.destroy_sent_bulk', 'uses' => 'MailboxController@destroy_sent_bulk']);

Route::put('users/update', ['as' => 'users.update', 'uses' => 'UserController@update']);
Route::put('users/update_agreement', ['as' => 'users.update_agreement', 'uses' => 'UserController@update_agreement']);
Route::put('users/update_block', ['as' => 'users.update_block', 'uses' => 'UserController@update_block']);

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

Route::group(['prefix' => 'admin'], function () {

    Route::get('/keywords', ['as' => 'admin.keywords', 'uses' => 'PageController\AdminPageController@keyword_index']);
    Route::get('/keywords/create', ['as' => 'admin.keywords.create', 'uses' => 'PageController\AdminPageController@keyword_create']);


    Route::get('/index', ['as' => 'admin.index', 'uses' => 'PageController\AdminPageController@index']);
    Route::get('/novel', ['as' => 'admin.novel', 'uses' => 'PageController\AdminPageController@index']);
    Route::get('/novel/{id}', ['as' => 'admin.novel_inning', 'uses' => 'PageController\AdminPageController@novel_inning']);
    Route::get('/novel/inning/{id}', ['as' => 'admin.novel_inning_view', 'uses' => 'PageController\AdminPageController@novel_inning_view']);

    Route::get('/users', ['as' => 'admin.users', 'uses' => 'PageController\AdminPageController@users']);
    Route::get('/user/{id}', ['as' => 'admin.profile', 'uses' => 'PageController\AdminPageController@profile']);
    Route::get('/sales', ['as' => 'admin.sales', 'uses' => 'PageController\AdminPageController@sales']);
    Route::get('/request', ['as' => 'admin.request', 'uses' => 'PageController\AdminPageController@request']);
    Route::get('/request/{id}', ['as' => 'admin.request_view', 'uses' => 'PageController\AdminPageController@request_view']);
    Route::post('/request/{id}/answer', ['as' => 'admin.request_answer', 'uses' => 'MenToMenQuestionAnswerController@answer']);

    Route::get('/memo', ['as' => 'admin.memo', 'uses' => 'PageController\AdminPageController@memo']);
    Route::get('/memo_detail/{id}', ['as' => 'admin.memo_view', 'uses' => 'PageController\AdminPageController@memo_view']);
    Route::get('/memo_create', ['as' => 'admin.memo_create', 'uses' => 'PageController\AdminPageController@memo_create']);
    Route::get('/novel_memo_send', ['as' => 'admin.novel_memo_send', 'uses' => 'PageController\AdminPageController@mailbox_send']);
    Route::get('/mailbox_send_message/{id}', ['as' => 'admin.mailbox_send_message', 'uses' => 'PageController\AdminPageController@mailbox_send_message_show']);
    Route::get('/specific_mail/{id?}', ['as' => 'admin.specific_mail', 'uses' => 'PageController\AdminPageController@specific_mailbox_create']);

    Route::get('/partnership/manage_company', ['as' => 'admin.partner_manage_company', 'uses' => 'PageController\AdminPageController@partner_manage_company']);
    Route::get('/partnership/manage_apply/{id?}', ['as' => 'admin.partner_manage_apply', 'uses' => 'PageController\AdminPageController@partner_manage_apply']);
    Route::get('/partnership/create_company', ['as' => 'admin.partner_create_company', 'uses' => 'PageController\AdminPageController@partner_create_company']);
    Route::get('/partnership/edit_company/{id}', ['as' => 'admin.partner_edit_company', 'uses' => 'PageController\AdminPageController@partner_edit_company']);
    Route::get('/partnership/test_inning/{id?}', ['as' => 'admin.partner_test_inning', 'uses' => 'PageController\AdminPageController@partner_test_inning']);
    Route::get('/partnership/approve_inning/{id?}', ['as' => 'admin.partner_approve_inning', 'uses' => 'PageController\AdminPageController@partner_approve_inning']);

    Route::get('/faqs', ['as' => 'admin.faqs', 'uses' => 'PageController\AdminPageController@faq_index']);
    Route::get('/faqs/create', ['as' => 'admin.faqs.create', 'uses' => 'PageController\AdminPageController@faq_create']);
    Route::get('/faqs/{id}/edit', ['as' => 'admin.faqs.edit', 'uses' => 'PageController\AdminPageController@faq_edit']);

    Route::get('/notifications', ['as' => 'admin.notifications', 'uses' => 'PageController\AdminPageController@notifications']);
    Route::get('/notifications/create', ['as' => 'admin.notifications.create', 'uses' => 'PageController\AdminPageController@notifications_create']);
    Route::post('/notifications/create', ['as' => 'admin.notifications.create.post', 'uses' => 'NotificationController@store']);

    Route::get('/notifications/{id}', ['as' => 'admin.notifications.detail', 'uses' => 'PageController\AdminPageController@notifications_detail'])
        ->where(['id' => '[0-9]+']);

    Route::get('/notifications/{id}/edit', ['as' => 'admin.notifications.update', 'uses' => 'PageController\AdminPageController@notifications_update'])
        ->where(['id' => '[0-9]+']);
    Route::put('/notifications/{id}/edit', ['as' => 'admin.notifications.update.put', 'uses' => 'NotificationController@update'])
        ->where(['id' => '[0-9]+']);
});

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
    Route::get('freeboard_write', ['middleware' => 'auth', 'as' => 'free_board.write', 'uses' => 'MainController\CommunityController@free_board_write']);
    Route::post('freeboard/', ['as' => 'free_board.store', 'uses' => 'FreeBoardController@store']);

    Route::get('reader_reco', ['as' => 'reader_reco', 'uses' => 'MainController\CommunityController@reader_reco']);
    Route::get('reader_reco/{id}', ['as' => 'reader_reco.detail', 'uses' => 'MainController\CommunityController@reader_reco_detail']);
    Route::post('reader_reco/{id}', ['as' => 'reader_reco.comment', 'middleware' => 'auth', 'uses' => 'ReviewCommentController@store']);

});

//EachController
Route::get('/novel_group/{id}', ['as' => 'each_novel.novel_group', 'uses' => 'MainController\EachController@novel_group']);
Route::get('novel_group/review/{id}', ['middleware' => 'auth', 'as' => 'each_novel.novel_group.review', 'uses' => 'MainController\EachController@novel_group_review']);
Route::get('/novel_group_inning/{id}', ['as' => 'each_novel.novel_group_inning', 'uses' => 'MainController\EachController@novel_group_inning']);

//AskController
Route::get('/frequently_asked_questions', ['as' => 'ask.faqs', 'uses' => 'MainController\AskController@faqs']);
Route::get('/questions', ['as' => 'ask.questions', 'uses' => 'MainController\AskController@questions']);
Route::get('/ask_question', ['as' => 'ask.ask_question', 'uses' => 'MainController\AskController@ask_question']);
Route::get('/notifications', ['as' => 'ask.notifications', 'uses' => 'MainController\AskController@notifications']);
Route::get('/notification_detail/{id}', ['as' => 'ask.notification_detail', 'uses' => 'MainController\AskController@notification_detail']);
Route::get('/question_detail/{id}', ['as' => 'ask.question_detail', 'uses' => 'MainController\AskController@question_detail']);
Route::get('/faq_detail/{id}', ['as' => 'ask.faq_detail', 'uses' => 'MainController\AskController@faq_detail']);
Route::get('/accusations/{id}', ['as' => 'accusations', 'uses' => 'MainController\AskController@accusations']);
Route::post('/accusations', ['as' => 'accusations.post', 'uses' => 'AccusationController@store']);

//my information
Route::group(['prefix' => 'my_info', 'middleware' => ['auth']], function () {
    //MyPageController
    Route::get('/', ['as' => 'my_page.index', 'uses' => 'MainController\MyPageController@index']);
    Route::get('/favorites', ['as' => 'my_page.favorites', 'uses' => 'MainController\MyPageController@favorites']);
    Route::get('/novels/new_speed', ['as' => 'my_page.novels.new_speed', 'uses' => 'MainController\MyPageController@new_speed']);
    Route::get('/novels/new_speed/read/{id}', ['as' => 'my_page.novels.new_speed.read', 'uses' => 'MainController\MyPageController@new_speed_read']);
    Route::get('/novels/new_novels', ['as' => 'my_page.novels.new_novels', 'uses' => 'MainController\MyPageController@new_novels']);

    Route::group(['prefix' => 'personal'], function () {
        Route::get('/post_manage', ['as' => 'my_info.post_manage', 'uses' => 'MainController\MyInfoController@post_manage']);
        Route::get('/review_manage', ['as' => 'my_info.review_manage', 'uses' => 'MainController\MyInfoController@review_manage']);
        Route::get('/novel_comments_manage', ['as' => 'my_info.novel_comments_manage', 'uses' => 'MainController\MyInfoController@novel_comments_manage']);
        Route::get('/free_board_review_comments_manage', ['as' => 'my_info.free_board_review_comments_manage', 'uses' => 'MainController\MyInfoController@free_board_review_comments_manage']);
        Route::get('/password_again', ['as' => 'my_info.password_again', 'uses' => 'MainController\MyInfoController@password_again']);
        Route::post('/password_again', ['as' => 'my_info.password_again.post', 'uses' => 'MainController\MyInfoController@password_again_post']);
        Route::get('/edit', ['as' => 'my_info.edit', 'uses' => 'MainController\MyInfoController@edit']);
        Route::post('/edit', ['as' => 'my_info.edit.post', 'uses' => 'UserController@my_info_update']);
        Route::get('/member_leave/password_again', ['as' => 'my_info.member_leave.password_again', 'uses' => 'MainController\MyInfoController@member_leave_password_again']);
        Route::post('/member_leave', ['as' => 'my_info.member_leave', 'uses' => 'UserController@member_leave']);
        Route::post('/free_board_review_comments_remove', ['as' => 'free_board_review_comments.destroy_comments', 'uses' => 'MainController\MyInfoController@destroy_comments']);
        Route::put('/free_board_review_comments_update', ['as' => 'free_board_review_comments.update_comments', 'uses' => 'MainController\MyInfoController@update_comments']);
    });

    Route::group(['prefix' => 'use_info'], function () {
        Route::get('/charge_bead', ['as' => 'my_info.charge_bead', 'uses' => 'MainController\MyInfoController@charge_bead']);
        Route::get('/charge_list', ['as' => 'my_info.charge_list', 'uses' => 'MainController\MyInfoController@charge_list']);
        Route::get('/manage_piece', ['as' => 'my_info.manage_piece', 'uses' => 'MainController\MyInfoController@manage_piece']);
        Route::get('/purchased_novel_list', ['as' => 'my_info.purchased_novel_list', 'uses' => 'MainController\MyInfoController@purchased_novel_list']);
        Route::get('/received_gift', ['as' => 'my_info.received_gift', 'uses' => 'MainController\MyInfoController@received_gift']);
        Route::get('/sent_gift', ['as' => 'my_info.sent_gift', 'uses' => 'MainController\MyInfoController@sent_gift']);

    });
});

//Mails Controller
Route::group(['prefix' => 'mails', 'middleware' => ['auth']], function () {
    Route::get('/received', ['as' => 'mails.received', 'uses' => 'MainController\MailController@received']);
    Route::get('/sent', ['as' => 'mails.sent', 'uses' => 'MainController\MailController@sent']);
    Route::get('/spam', ['as' => 'mails.spam', 'uses' => 'MainController\MailController@spam']);
    Route::get('/my_box', ['as' => 'mails.my_box', 'uses' => 'MainController\MailController@my_box']);
    Route::get('/create/{id?}', ['as' => 'mails.create', 'uses' => 'MainController\MailController@create']);
    Route::get('/detail/{id}', ['as' => 'mails.detail', 'uses' => 'MainController\MailController@detail']);
    Route::get('/sent_detail/{id}', ['as' => 'mails.sent_detail', 'uses' => 'MainController\MailController@sent_detail']);
});

//Mails Controller
Route::group(['prefix' => 'search'], function () {
    Route::post('/', ['as' => 'search.index', 'uses' => 'MainController\SearchController@index']);
    Route::get('/', ['as' => 'search', 'uses' => 'MainController\SearchController@index']);
});
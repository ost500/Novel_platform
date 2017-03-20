<?php


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'phone_num' => $faker->phoneNumber,
        'bank' => "IBK",
        'account_holder' => $faker->name,
        'account_number' => $faker->bankAccountNumber,
        'nickname' => $faker->name,
        'user_name' => $faker->name,
        'birth_of_year' => $faker->year,
        'auth_mail_code' => str_random(10),
        'bead' => 100,
        'piece' => 100
    ];
});

$factory->define(App\NovelGroup::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'nickname_id' => $faker->randomElement(['1', '2', '3']),
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'latest_at' => $faker->date('Y-m-d'),
        'cover_photo' => "default_.jpg",
        'completed' => $faker->randomElement(['0', '1'])
    ];
});

$factory->define(App\Novel::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    $novel_groupIds = App\NovelGroup::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'novel_group_id' => $faker->randomElement($novel_groupIds),
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'author_comment' => $faker->paragraph,
        'non_free_agreement' => 0
//        'non_free_agreement' => $faker->randomElement(['0', '1'])
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    $novelIds = App\Novel::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'novel_id' => $faker->randomElement($novelIds),
        'parent_id' => 0,
        'comment' => $faker->sentence,
    ];
});

$factory->define(App\NickName::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'nickname' => $faker->name,
    ];
});


$factory->define(App\Mailbox::class, function (Faker\Generator $faker) {
    $novelIds = App\NovelGroup::pluck('id')->toArray();
    $userId_fake1 = App\User::pluck('id')->toArray();

//    $userId_fake = $faker->randomElement($userIds);
//    while (true) {
//        $userId_fake2 = $faker->randomElement($userIds);
//        if ($userId_fake != $userId_fake2) {
//            break;
//        }
//    }
//    echo $userId_fake.$userId_fake2;
    return [
//        'to' => $userId_fake,

        'from' => $faker->randomElement($userId_fake1),
        'novel_group_id' => $faker->randomElement($novelIds),
        'subject' => $faker->sentence,
        'body' => $faker->paragraph,

    ];
});

$factory->define(App\MenToMenQuestionAnswer::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userIds),
        'category' => $faker->randomElement(['사이트 이용', '회원정보', '구매/결제', '작가/연재', 'APP', '건의사항', '기타']),
        'title' => $faker->sentence,
        'question' => $faker->paragraph,
        'answer' => $faker->randomElement([$faker->paragraph, ' ']),
        'status' => $faker->randomElement(['0', '1']),
    ];
});

$factory->define(App\Faq::class, function (Faker\Generator $faker) {
    return [
        'faq_category' => $faker->randomElement(['사이트 이용', '회원정보', '구매/결제', '작가/연재', 'APP', '건의사항', '기타', '독자']),
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
    ];
});

$factory->define(App\Review::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    $novelgroupIds = App\NovelGroup::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'novel_group_id' => $faker->randomElement($novelgroupIds),
        'review' => $faker->paragraph,
        'title' => $faker->sentence,
    ];
});

$factory->define(App\MailLog::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    $novelIds = App\NovelGroup::pluck('id')->toArray();
    $mailIds = App\Mailbox::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'novel_group_id' => $faker->randomElement($novelIds),
        'mailbox_id' => $faker->randomElement($mailIds)
    ];
});

$factory->define(App\Favorite::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    $novelgroupIds = App\NovelGroup::pluck('id')->toArray();


    return [
        'user_id' => $faker->randomElement($userIds),
        'novel_group_id' => $faker->randomElement($novelgroupIds),

    ];
});

$factory->define(\App\Keyword::class, function (Faker\Generator $faker) {
    return [
        'category' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7']),
        'name' => $faker->word,

    ];
});

$factory->define(\App\ViewCount::class, function (Faker\Generator $faker) {
    $novelIds = App\Novel::pluck('id')->toArray();
    return [
        'novel_id' => $faker->randomElement($novelIds),
        'date' => $faker->date('Y-m-d'),
        'count' => $faker->randomElement(range(10, 50)),
        'separation' => $faker->randomElement(['1', '2', '3'])

    ];
});

$factory->define(\App\Company::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph,
        'initial_inning' => $faker->randomElement(['1', '2', '3', '4', '5']),
        'adult' => $faker->randomElement(['0', '1']),
    ];
});
$factory->define(\App\PublishNovelGroup::class, function (Faker\Generator $faker) {
    $novel_groupIds = App\NovelGroup::pluck('id')->toArray();

    $random_novel_group = $faker->randomElement($novel_groupIds);
    $random_user_id = App\NovelGroup::find($random_novel_group)->user_id;
    return [
        'user_id' => $random_user_id,
        'novel_group_id' => $random_novel_group,

    ];
});

$factory->define(\App\NovelGroupPublishCompany::class, function (Faker\Generator $faker) {
    $publish_novel_groupIds = App\PublishNovelGroup::pluck('id')->toArray();
    $companyIds = App\Company::pluck('id')->toArray();
    return [
        'publish_novel_group_id' => $faker->randomElement($publish_novel_groupIds),
        'company_id' => $faker->randomElement($companyIds),
        'status' => $faker->randomElement(['심사중', '승인', '거절']),
        'days' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7']),
        'novels_per_days' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']),
        'initial_novels' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']),
    ];
});

$factory->define(App\RecentlyVisitedNovel::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    $novel_ids = App\Novel::pluck('id')->toArray();
    $novel_groupIds = App\NovelGroup::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userIds),
        'novel_id' => $faker->randomElement($novel_ids),
        'novel_group_id' => $faker->randomElement($novel_groupIds),
    ];
});

$factory->define(App\Notification::class, function (Faker\Generator $faker) {
    return [
        'category' => $faker->word,
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
    ];
});

$factory->define(\App\FreeBoard::class, function (Faker\Generator $faker) {
    $userId = App\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userId),
        'title' => $faker->sentence(),
        'content' => $faker->paragraph(),
    ];
});

$factory->define(\App\FreeBoardComment::class, function (Faker\Generator $faker) {
    $userId = App\User::pluck('id')->toArray();
    $freeboardId = App\FreeBoard::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userId),
        'free_board_id' => $faker->randomElement($freeboardId),
        'comment' => $faker->sentence(),
    ];
});

$factory->define(\App\FreeBoardLike::class, function (Faker\Generator $faker) {
    $userId = App\User::pluck('id')->toArray();
    $freeboardId = App\FreeBoard::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userId),
        'free_board_id' => $faker->randomElement($freeboardId),
    ];
});

$factory->define(App\ReviewComment::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    $novelIds = App\Novel::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'review_id' => $faker->randomElement($novelIds),
        'parent_id' => 0,
        'comment' => $faker->sentence,
    ];
});

$factory->define(App\NewSpeed::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();


    return [
        'user_id' => $faker->randomElement($userIds),
        'title' => $faker->sentence(),
        'link' => route('root'),
        'image' => '/img/novel_covers/default_1.jpg',

    ];
});

$factory->define(App\NewSpeedLog::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    $newSpeeds = App\NewSpeed::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'new_speed_id' => $faker->randomElement($newSpeeds),
        'read' => 0
    ];
});

$factory->define(App\Payment::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'content' => $faker->sentence(),
        'numbers' => $faker->randomNumber(),
        'method' => $faker->randomElement(['휴대폰', '가상계좌', '계좌이체', '휴대폰', '네이버페이', '카카오페이', '해피머니']),
    ];
});

$factory->define(App\Piece::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'content' => $faker->sentence(),
        'numbers' => $faker->randomNumber(),
        'deadline' => $faker->dateTimeBetween('+1 months', '+3 months'),


    ];
});

$factory->define(App\PurchasedNovel::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    $novelIds = App\Novel::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'novel_id' => $faker->randomElement($novelIds),
        'method' => $faker->randomElement(['조각', '구슬']),
        'status' => $faker->randomElement([1, 0]),
    ];
});

$factory->define(App\Present::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    $fromUserIds = App\User::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'from_id' => $faker->randomElement($fromUserIds),
        'content' => $faker->sentence(),
        'status' => $faker->randomElement(['수령', '반송', '대기']),
        'numbers' => $faker->randomNumber(),
    ];
});

$factory->define(App\Accusation::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    $accuUserIds = App\User::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'accu_id' => $faker->randomElement($accuUserIds),
        'contents' => $faker->sentence(),
        'title' => $faker->sentence(),
        'category' => $faker->sentence(),
    ];
});
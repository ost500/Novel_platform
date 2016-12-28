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
        'remember_token' => str_random(10),
        'phone_num' => $faker->phoneNumber,
        'bank' => "IBK",
        'account_holder' => $faker->name,
        'account_number' => $faker->bankAccountNumber
    ];
});

$factory->define(App\NovelGroup::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'nickname' => $faker->randomElement(['1', '2', '3']),
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'keyword1' => $faker->word,
        'keyword2' => $faker->word,
        'keyword3' => $faker->word,
        'keyword4' => $faker->word,
        'keyword5' => $faker->word,
        'keyword6' => $faker->word,
        'keyword7' => $faker->word,
        'latest_at' => $faker->date('Y-m-d'),
        'cover_photo' => "default_.jpg"
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
        'title' => $faker->sentence,
        'question' => $faker->paragraph,
        'answer' => $faker->randomElement([$faker->paragraph, ' ']),
        'status' => $faker->randomElement(['0', '1']),
    ];
});

$factory->define(App\Faq::class, function (Faker\Generator $faker) {
    return [
        'faq_category' => $faker->randomElement(['1', '2', '3']),
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
    ];
});

$factory->define(App\Review::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    $novelIds = App\Novel::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'novel_id' => $faker->randomElement($novelIds),
        'review' => $faker->sentence,
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
        'initial_inning' => $faker->randomElement(['1', '2', '3', '4', '5']),
        'adult_allowance' => $faker->randomElement(['0', '1']),
    ];
});
$factory->define(\App\PublishNovelGroup::class, function (Faker\Generator $faker) {
    $novel_groupIds = App\NovelGroup::pluck('id')->toArray();
    return [
        'novel_group_id' => $faker->randomElement($novel_groupIds),
        'days' => $faker->randomElement(['1','2','3','4','5','6','7']),
        'novels_per_days' => $faker->randomElement(['1','2','3','4','5','6','7','8','9','10']),
    ];
});

$factory->define(\App\NovelGroupPublishCompany::class, function (Faker\Generator $faker) {
    $publish_novel_groupIds = App\PublishNovelGroup::pluck('id')->toArray();
    $companyIds = App\Company::pluck('id')->toArray();
    return [
        'publish_novel_group_id' => $faker->randomElement($publish_novel_groupIds),
        'company_id' => $faker->randomElement($companyIds),
        'status' => $faker->randomElement(['신청하기', '대기 중','심사 중','승인','거절']),
    ];
});
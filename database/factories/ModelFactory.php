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
        'bank' => "기업은행",
        'account_holder' => $faker->name,
        'account_number' => $faker->bankAccountNumber
    ];
});

$factory->define(App\NovelGroup::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();

    return [
        'user_id' => $faker->randomElement($userIds),
        'nickname' => $faker->word,
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'keyword1' => $faker->word,
        'keyword2' => $faker->word,
        'keyword3' => $faker->word,
        'keyword4' => $faker->word,
        'keyword5' => $faker->word,
        'keyword6' => $faker->word,
        'keyword7' => $faker->word,
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

$factory->define(App\Faq::class, function (Faker\Generator $faker) {
    return [
        'faq_category' => $faker->randomElement(['1','2','3']),
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
    ];
});

$factory->define(App\MenToMenQuestionAnswers::class, function (Faker\Generator $faker) {
    $userIds = App\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($userIds),
        'title' => $faker->sentence,
        'question' => $faker->paragraph,
        'answer' => $faker->randomElement([$faker->paragraph,' ']),
        'status' =>$faker->randomElement(['0','1']),
    ];
});


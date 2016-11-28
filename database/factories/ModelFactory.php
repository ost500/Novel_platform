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



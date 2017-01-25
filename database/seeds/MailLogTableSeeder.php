<?php

use Illuminate\Database\Seeder;

class MailLogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::get();

        App\MailLog::truncate();

        $users->each(function ($user) {
            $user->maillogs()->save(factory(App\MailLog::class)->make());
            $user->maillogs()->save(factory(App\MailLog::class)->make());
            $user->maillogs()->save(factory(App\MailLog::class)->make());
            $user->maillogs()->save(factory(App\MailLog::class)->make());
            $user->maillogs()->save(factory(App\MailLog::class)->make());
            $user->maillogs()->save(factory(App\MailLog::class)->make());
        });
    }
}

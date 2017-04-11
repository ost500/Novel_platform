<?php

use Illuminate\Database\Seeder;

class NickNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::get();

        App\NickName::truncate();

        $users->each(function ($user) {
            $nick1 = $user->nicknames()->save(factory(App\NickName::class)->make());
            $nick1->main = true;
            $nick1->save();
            $user->nickname=$nick1->nickname;
            $user->save();
        });
    }
}

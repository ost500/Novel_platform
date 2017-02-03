<?php

use Illuminate\Database\Seeder;

class NewSpeedLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::get();

        $users->each(function ($user) {
            $user->new_speed_logs()->save(factory(App\NewSpeedLog::class)->make());
            $user->new_speed_logs()->save(factory(App\NewSpeedLog::class)->make());
            $user->new_speed_logs()->save(factory(App\NewSpeedLog::class)->make());
            $user->new_speed_logs()->save(factory(App\NewSpeedLog::class)->make());
            $user->new_speed_logs()->save(factory(App\NewSpeedLog::class)->make());
            $user->new_speed_logs()->save(factory(App\NewSpeedLog::class)->make());
            $user->new_speed_logs()->save(factory(App\NewSpeedLog::class)->make());
        });
    }
}

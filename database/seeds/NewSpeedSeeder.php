<?php

use Illuminate\Database\Seeder;

class NewSpeedSeeder extends Seeder
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
            $user->new_speeds()->save(factory(App\NewSpeed::class)->make());
        });
    }
}

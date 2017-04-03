<?php

use Illuminate\Database\Seeder;

class AccusationSeeder extends Seeder
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
            $user->accuse()->save(factory(App\Accusation::class)->make());
            $user->accuse()->save(factory(App\Accusation::class)->make());
            $user->accuse()->save(factory(App\Accusation::class)->make());
            $user->accuse()->save(factory(App\Accusation::class)->make());
        });
    }
}

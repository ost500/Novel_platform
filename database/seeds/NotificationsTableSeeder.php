<?php

use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Notification::truncate();
        factory(App\RecentlyVisitedNovel::class,10)->create();
    }
}

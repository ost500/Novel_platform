<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setUp();

        if (!app()->environment('production')) {
            $this->runDevSeed();
        }

        $this->tearDown();

        // $this->call(UsersTableSeeder::class);
    }

    private function setUp()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

    private function tearDown()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    private function runDevSeed()
    {
        // users table
        $this->call(UsersTableSeeder::class);

        $users = App\User::get();

        // NovelGroup table
        App\NovelGroup::truncate();

        $users->each(function ($user) {
            $user->novel_groups()->save(factory(App\NovelGroup::class)->make());
            $user->novel_groups()->save(factory(App\NovelGroup::class)->make());
        });

        $novel_groups = App\NovelGroup::get();

        // novel table
        App\Novel::truncate();
        foreach ($novel_groups as $novel_group) {
            $new_novel = $novel_group->novels()->save(factory(App\Novel::class)->make());
            $new_novel->user_id = $novel_group->user_id;
            $new_novel->save();

            $new_novel2 = $novel_group->novels()->save(factory(App\Novel::class)->make());
            $new_novel2->user_id = $novel_group->user_id;
            $new_novel2->save();

        }

        $this->command->info('comments table seeded');
    }
}

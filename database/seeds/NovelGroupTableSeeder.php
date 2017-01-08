<?php

use Illuminate\Database\Seeder;

class NovelGroupTableSeeder extends Seeder
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
            $new_novel_group1 = $user->novel_groups()->save(factory(App\NovelGroup::class)->make());
            $new_novel_group1->nickname = $user->nicknames[0]->id;
            $new_novel_group1->save();
            $new_novel_group2 = $user->novel_groups()->save(factory(App\NovelGroup::class)->make());
            $new_novel_group2->nickname = $user->nicknames[1]->id;
            $new_novel_group2->save();
        });
    }
}

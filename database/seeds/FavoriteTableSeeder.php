<?php

use Illuminate\Database\Seeder;

class FavoriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Favorite::truncate();
        $novel_groups = App\NovelGroup::get();

        foreach ($novel_groups as $novel_group) {
            $novel_group->favorites()->save(factory(App\Favorite::class)->make());
        }


    }
}

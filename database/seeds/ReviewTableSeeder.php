<?php

use Illuminate\Database\Seeder;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $novelGroups = App\NovelGroup::get();

        App\Review::truncate();
        foreach ($novelGroups as $novel) {
            $novel->reviews()->save(factory(App\Review::class)->make());

            $novel->reviews()->save(factory(App\Review::class)->make());

//            $novel->comments()->save(factory(App\Comment::class)->make());
        }
    }
}

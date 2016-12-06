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
        $novels = App\Novel::get();

        App\Review::truncate();
        foreach ($novels as $novel) {
            $novel->reviews()->save(factory(App\Review::class)->make());

            $novel->reviews()->save(factory(App\Review::class)->make());

//            $novel->comments()->save(factory(App\Comment::class)->make());
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class NovelGroupKeywordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $novel_groups = App\NovelGroup::get();

        $novel_groups->each(function ($novel_group) {
            $faker = Faker::create();
            foreach (range(1, 7) as $index) {
                $new_keywords = new \App\NovelGroupKeyword();
                $new_keywords->novel_group_id = $novel_group->id;
                $keywords = \App\Keyword::where('category', $index)->pluck('id')->toArray();
                $new_keywords->keyword_id = $faker->randomElement($keywords);
                $new_keywords->save();
            }
        });
    }
}

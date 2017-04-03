<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class NovelGroupHashTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\NovelGroupHashTag::truncate();

        $novel_groups = App\NovelGroup::get();
        $novel_groups->each(function ($novel_group) {
            $faker = Faker::create();
            foreach (range(2, 7) as $index) {
                $new_hash_tags = new \App\NovelGroupHashTag();
                $new_hash_tags->novel_group_id = $novel_group->id;
                $keywords = \App\Keyword::where('category', $index)->pluck('name')->toArray();

                $new_hash_tags->tag = $faker->randomElement($keywords);

                $new_hash_tags->save();

            }
        });
    }
}

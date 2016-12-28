<?php

use Illuminate\Database\Seeder;

class PublishNovelGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $novel_groups = App\NovelGroup::get();

        \App\PublishNovelGroup::truncate();
        // factory(App\Publish_novel_group::class, 10)->create();
        foreach ($novel_groups as $novel_group) {

            $novel_group->publish_novel_groups()->save(factory(App\PublishNovelGroup::class)->make());
            // $novel->reviews()->save(factory(App\Review::class)->make());
        }

    }
}

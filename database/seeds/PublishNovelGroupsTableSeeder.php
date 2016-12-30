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
     //   factory(App\PublishNovelGroup::class, 10)->create();
        foreach ($novel_groups as $novel_group) {
            $publish_novel_group = $novel_group->publish_novel_groups()->save(factory(App\PublishNovelGroup::class)->make());
            $publish_novel_group->user_id = $novel_group->user_id;
            $publish_novel_group->save();
        }

    }
}

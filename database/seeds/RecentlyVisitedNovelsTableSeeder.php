<?php

use Illuminate\Database\Seeder;

class RecentlyVisitedNovelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $novel_groups = App\NovelGroup::with('novels')->get();

        \App\RecentlyVisitedNovel::truncate();
        foreach ($novel_groups as $novel_group) {
            $recently_visited_novel_group_novel = $novel_group->recently_visited_novels()->save(factory(App\RecentlyVisitedNovel::class)->make());
            $recently_visited_novel_group_novel->novel_id = $novel_group->novels[0]->id;
            $recently_visited_novel_group_novel->save();
        }
    }
}

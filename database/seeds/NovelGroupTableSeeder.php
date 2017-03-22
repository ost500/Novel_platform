<?php

use App\NovelGroup;
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

        $new_novel_group = new NovelGroup();
        $new_novel_group->title = "괴롭히고 싶다";
        $new_novel_group->description = "";
        $new_novel_group->nickname_id = 1;
        $new_novel_group->user_id = 1;
        $new_novel_group->cover_photo = "thumb/noon1.png";
        $new_novel_group->save();


        $new_novel_group = new NovelGroup();
        $new_novel_group->title = "공녀 엘린";
        $new_novel_group->description = "";
        $new_novel_group->nickname_id = 1;
        $new_novel_group->user_id = 1;
        $new_novel_group->cover_photo = "thumb/novel_detail1.png";
        $new_novel_group->save();

        $new_novel_group = new NovelGroup();
        $new_novel_group->title = "꽃";
        $new_novel_group->description = "";
        $new_novel_group->nickname_id = 1;
        $new_novel_group->user_id = 1;
        $new_novel_group->cover_photo = "thumb/noon2.png";
        $new_novel_group->save();

        $new_novel_group = new NovelGroup();
        $new_novel_group->title = "망의 연월";
        $new_novel_group->description = "";
        $new_novel_group->nickname_id = 1;
        $new_novel_group->user_id = 1;
        $new_novel_group->cover_photo = "thumb/charge_book1.png";
        $new_novel_group->save();

        $new_novel_group = new NovelGroup();
        $new_novel_group->title = "잔혹한 다정함에게";
        $new_novel_group->description = "";
        $new_novel_group->nickname_id = 1;
        $new_novel_group->user_id = 1;
        $new_novel_group->cover_photo = "thumb/noon3.png";
        $new_novel_group->save();


        $users->each(function ($user) {
            $new_novel_group1 = $user->novel_groups()->save(factory(App\NovelGroup::class)->make());
            $new_novel_group1->nickname_id = $user->nicknames[0]->id;
            $new_novel_group1->save();
            $new_novel_group2 = $user->novel_groups()->save(factory(App\NovelGroup::class)->make());
            $new_novel_group2->nickname_id = $user->nicknames[1]->id;
            $new_novel_group2->save();
        });
    }
}

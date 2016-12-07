<?php

use App\Faq;
use App\MenToMenQuestionAnswer;
use App\NovelGroup;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setUp();

        if (!app()->environment('production')) {
            $this->runDevSeed();
        }

        $this->tearDown();

        // $this->call(UsersTableSeeder::class);
    }

    private function setUp()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

    private function tearDown()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    private function runDevSeed()
    {
        // users table
        $this->call(UsersTableSeeder::class);

        //NickName Table
        $this->call(NickNameSeeder::class);

        $users = App\User::get();

        // NovelGroup table
        App\NovelGroup::truncate();

        $users->each(function ($user) {
            $new_novel_group1 = $user->novel_groups()->save(factory(App\NovelGroup::class)->make());
            $new_novel_group1->nickname = $user->nicknames[0]->id;
            $new_novel_group1->save();
            $new_novel_group2 = $user->novel_groups()->save(factory(App\NovelGroup::class)->make());
            $new_novel_group2->nickname = $user->nicknames[1]->id;
            $new_novel_group2->save();
        });

        $novel_groups = App\NovelGroup::get();

        // novels table
        App\Novel::truncate();
        foreach ($novel_groups as $novel_group) {
            $new_novel = $novel_group->novels()->save(factory(App\Novel::class)->make());
            $new_novel->user_id = $novel_group->user_id;
            $new_novel->save();

            $new_novel2 = $novel_group->novels()->save(factory(App\Novel::class)->make());
            $new_novel2->user_id = $novel_group->user_id;
            $new_novel2->save();

        }

        $this->command->info('novel table seeded');

        // comment table
        $novels = App\Novel::get();

        App\Comment::truncate();
        foreach ($novels as $novel) {
            $new_comment = $novel->comments()->save(factory(App\Comment::class)->make());

            $new_child_comment = $novel->comments()->save(factory(App\Comment::class)->make());
            $new_child_comment->parent_id = $new_comment->id;
            $new_child_comment->save();


            $novel->comments()->save(factory(App\Comment::class)->make());
        }

        $this->command->info('comments table seeded');


        //Mailbox table
        App\Mailbox::truncate();
        $users->each(function ($user) {
            $user->mailbox()->save(factory(App\Mailbox::class)->make());
        });

        $this->command->info('Mails table seeded');


        //MenToMen QuestionAnswer table
        App\MenToMenQuestionAnswer::truncate();
        factory(App\MenToMenQuestionAnswer::class, 10)->create();

        $this->command->info('MenToMenQuestionAnswers table seeded');

        //Faq table
        Faq::truncate();
        factory(Faq::class, 20)->create();

        $this->command->info('faqs table seeded');

        $this->call(ReviewTableSeeder::class);

        $ng = NovelGroup::get();
        foreach($ng as $novelgroup)
        {
            $this->inning_order($novelgroup->id);
        }
        $this->command->info('inning ordering');

    }
    public
    function inning_order($id)
    {
        $novel_group = NovelGroup::find($id);
        $novels = $novel_group->novels;

        $index = 1;
        foreach ($novels as $novel) {
            if ($novel->adult != 0) {
                $novel->inning = $novel->adult;
                $novel->save();
                continue;
            }
            $novel->inning = $index;
            $novel->save();
            $index++;
        }
    }
}

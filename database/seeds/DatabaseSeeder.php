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

        $this->call(CompaniesTableSeeder::class);

        //NovelGroup Table
        $this->call(NovelGroupTableSeeder::class);

        $novel_groups = App\NovelGroup::get();

        // novels table
        App\Novel::truncate();
        foreach ($novel_groups as $index => $novel_group) {

            $new_novel = $novel_group->novels()->save(factory(App\Novel::class)->make());
            $new_novel->user_id = $novel_group->user_id;
            if ($index % 2 == 1) {
                $new_novel->non_free_agreement = true;
            }
            $new_novel->save();

            $new_novel2 = $novel_group->novels()->save(factory(App\Novel::class)->make());
            $new_novel2->user_id = $novel_group->user_id;
            $new_novel2->save();

            $new_novel3 = $novel_group->novels()->save(factory(App\Novel::class)->make());
            $new_novel3->user_id = $novel_group->user_id;
            $new_novel3->save();

            $new_novel4 = $novel_group->novels()->save(factory(App\Novel::class)->make());
            $new_novel4->user_id = $novel_group->user_id;
            $new_novel4->save();

            $new_novel5 = $novel_group->novels()->save(factory(App\Novel::class)->make());
            $new_novel5->user_id = $novel_group->user_id;
            $new_novel5->save();

            $new_novel6 = $novel_group->novels()->save(factory(App\Novel::class)->make());
            $new_novel6->user_id = $novel_group->user_id;
            $new_novel6->save();

            $new_novel7 = $novel_group->novels()->save(factory(App\Novel::class)->make());
            $new_novel7->user_id = $novel_group->user_id;
            $new_novel7->save();

            $new_novel8 = $novel_group->novels()->save(factory(App\Novel::class)->make());
            $new_novel8->user_id = $novel_group->user_id;
            $new_novel8->save();

            $new_novel9 = $novel_group->novels()->save(factory(App\Novel::class)->make());
            $new_novel9->user_id = $novel_group->user_id;
            $new_novel9->save();

            $new_novel10 = $novel_group->novels()->save(factory(App\Novel::class)->make());
            $new_novel10->user_id = $novel_group->user_id;
            $new_novel10->save();

        }

        $this->command->info('novel table seeded');

        // PublishNovelGroups table
        $this->call(PublishNovelGroupsTableSeeder::class);
        // NovelGroupPublishCompanies table
        $this->call(NovelGroupPublishCompaniesTableSeeder::class);


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
        foreach ($ng as $novelgroup) {
            $this->inning_order($novelgroup->id);
        }

        $this->call(MailBoxTableSeeder::class);
        $this->call(MailLogTableSeeder::class);

        $this->call(FavoriteTableSeeder::class);
        //KeywordTable
        $this->call(KeywordsTableSeeder::class);
        $this->command->info('Keywords seeded');
        $this->command->info('inning ordering');
        $this->call(NovelGroupKeywordSeeder::class);

    }


    public function inning_order($id)
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
        $novel_group->max_inning = --$index;
        $novel_group->save();
    }


}

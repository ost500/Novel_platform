<?php

use Illuminate\Database\Seeder;

class NovelGroupPublishCompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\NovelGroupPublishCompany::truncate();

        $publish_novel_groups = \App\PublishNovelGroup::get();
        $companies = \App\Company::get();



        foreach ($publish_novel_groups as $publish_novel_group) {


            foreach ($companies as $company) {
                $p = factory(App\NovelGroupPublishCompany::class)->make();
                $p->publish_novel_group_id = $publish_novel_group->id;
                $p->company_id = $company->id;
                $p->save();
            }


        }


    }
}

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
        factory(App\NovelGroupPublishCompany::class, 10)->create();
    }
}

<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\ViewCount;

class ViewCountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $novels = App\Novel::get();

        App\ViewCount::truncate();
        foreach ($novels as $novel) {
            //create novel today's views
            $today = Carbon::now()->toDateString();
            $view_count_instance = new ViewCount();
            $view_count_instance->novel_id = $novel->id;
            $view_count_instance->date = $today;
            $view_count_instance->separation = 1;
            $view_count_instance->count = 0;
            $view_count_instance->save();

            //create novel week's views
            $start_of_week = Carbon::now()->startOfWeek()->toDateString();
            $view_count_instance1 = new ViewCount();
            $view_count_instance1->novel_id = $novel->id;
            $view_count_instance1->date = $start_of_week;
            $view_count_instance1->separation = 2;
            $view_count_instance1->count = 0;
            $view_count_instance1->save();

            //create novel month's views
            $start_of_month = Carbon::now()->startOfMonth()->toDateString();
            $view_count_instance2 = new ViewCount();
            $view_count_instance2->novel_id = $novel->id;
            $view_count_instance2->date = $start_of_month;
            $view_count_instance2->separation = 3;
            $view_count_instance2->count = 0;
            $view_count_instance2->save();


        }
    }
}

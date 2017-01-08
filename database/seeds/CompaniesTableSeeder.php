<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Company::truncate();
        $arr = Array("네이버","카카오","예스24","교보");
        foreach($arr as $ar){
            $new_com = factory(App\Company::class)->create();
            $new_com->name = $ar;
            $new_com->save();
        }


    }
}

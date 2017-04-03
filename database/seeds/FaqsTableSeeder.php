<?php

use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Faq table
        \App\Faq::truncate();
        factory(\App\Faq::class, 100)->create();
        $faq_categories=['사이트이용','회원정보','구매/결제','작가/연재','APP','건의사항','기타'];
        foreach($faq_categories as $faq_category){
            $faq = factory(App\Faq::class)->make();
            $faq->faq_category =$faq_category ;
            $faq->best=1;
            $faq->save();
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class ReviewCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews = App\Review::get();

        $reviews->each(function ($review) {

            $new_review_comment = $review->comments()->save(factory(App\ReviewComment::class)->make());
            $new_review_comment->review_id = $review->id;
            $new_review_comment->save();
        });
    }
}

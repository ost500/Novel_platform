<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMenToMenQuestionAnswersCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('men_to_men_question_answers', function (Blueprint $table) {
            $table->string('category')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('men_to_men_question_answers', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
}

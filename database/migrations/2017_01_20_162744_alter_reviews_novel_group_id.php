<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterReviewsNovelGroupId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('reviews_novel_id_foreign');
            $table->dropColumn('novel_id');
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->integer('novel_group_id')->unsigned()->index()->after('user_id');
            $table->foreign('novel_group_id')->references('id')->on('novel_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('reviews', function (Blueprint $table) {
//            $table->integer('novel_id')->unsigned()->index()->after('user_id');
//            $table->foreign('novel_id')->references('id')->on('novels')->onDelete('cascade');
//        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign('reviews_novel_group_id_foreign');
            $table->dropColumn('novel_group_id');
        });
    }
}

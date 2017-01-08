<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPublishNovelGroupsUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publish_novel_groups', function (Blueprint $table) {

            $table->integer('user_id')->unsigned()->index();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publish_novel_groups', function (Blueprint $table) {
            $table->dropForeign('publish_novel_groups_user_id_foreign');
            $table->dropColumn('user_id');
        });
    }
}

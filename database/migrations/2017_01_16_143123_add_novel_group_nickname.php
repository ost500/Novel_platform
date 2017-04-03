<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNovelGroupNickname extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('novel_groups', function (Blueprint $table) {
            $table->dropColumn('nickname');
        });
        Schema::table('novel_groups', function (Blueprint $table) {
            $table->integer('nickname_id')->unsigned()->index();
            $table->foreign('nickname_id')->references('id')->on('nick_names');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('novel_groups', function (Blueprint $table) {
            $table->dropForeign('novel_groups_nickname_id_foreign');
            $table->dropColumn('nickname_id');
        });
        Schema::table('novel_groups', function (Blueprint $table) {
            $table->integer('nickname');
        });
    }
}

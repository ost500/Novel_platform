<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFreeBoardCommentsParentId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('free_board_comments', function (Blueprint $table) {
            $table->integer('parent_id')->nullable()->unsigned()->index();
            $table->foreign('parent_id')->references('id')->on('free_board_comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('free_board_comments', function (Blueprint $table) {

            $table->dropForeign('free_board_comments_parent_id_foreign');
            $table->dropColumn('parent_id');
        });
    }
}

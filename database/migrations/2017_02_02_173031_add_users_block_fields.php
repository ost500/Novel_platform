<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersBlockFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('block_login')->default(0);
            $table->boolean('block_send_mail')->default(0);
            $table->boolean('block_comment')->default(0);
            $table->boolean('block_free_board_review')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('block_login');
            $table->dropColumn('block_send_mail');
            $table->dropColumn('block_comment');
            $table->dropColumn('block_free_board_review');
        });
    }
}

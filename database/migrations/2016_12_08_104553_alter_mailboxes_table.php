<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMailboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mailboxes', function ($table) {
            $table->dropColumn('to');
            $table->dropColumn('from');
        });

        Schema::table('mailboxes', function ($table) {

            $table->integer('to')->unsigned()->index();
            $table->integer('from')->unsigned()->index();
            $table->integer('novel_id')->unsigned()->index();

            $table->foreign('to')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('from')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('novel_id')->references('id')->on('novels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mailboxes', function ($table) {
            $table->dropColumn('novel_id');

        });
    }
}

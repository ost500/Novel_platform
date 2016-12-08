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
            $table->dropForeign('mailboxes_from_foreign');
//            $table->dropForeign('mailboxes_to_foreign');
            $table->dropColumn('from');
            $table->dropColumn('to');
        });

        Schema::table('mailboxes', function ($table) {

//            $table->integer('to')->unsigned()->index();
            $table->integer('from')->unsigned()->index();
            $table->integer('novel_id')->unsigned()->index();
//
//            $table->foreign('to')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('from')->references('id')->on('users')->onDelete('cascade');
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
        if (Schema::hasColumn('mailboxes', 'novel_id')) {
            Schema::table('mailboxes', function ($table) {
                $table->dropForeign('mailboxes_novel_id_foreign');
                $table->dropColumn('novel_id');
            });
        }

    }
}

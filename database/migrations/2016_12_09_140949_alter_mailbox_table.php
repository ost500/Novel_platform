<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterMailboxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('mailboxes', 'novel_id')) {
            Schema::table('mailboxes', function ($table) {
                $table->dropForeign('mailboxes_novel_id_foreign');
                $table->dropColumn('novel_id');
            });
        }
        Schema::table('mailboxes', function ($table) {

            $table->integer('novel_group_id')->unsigned()->index()->nullable();

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
        if (Schema::hasColumn('mailboxes', 'novel_group_id')) {
            Schema::table('mailboxes', function ($table) {
                $table->dropForeign('mailboxes_novel_group_id_foreign');
                $table->dropColumn('novel_group_id');
            });
        }
        if (!Schema::hasColumn('mailboxes', 'novel_id')) {
            Schema::table('mailboxes', function ($table) {
                $table->integer('novel_id')->unsigned()->index();
//                $table->foreign('novel_id')->references('id')->on('novels')->onDelete('cascade');
            });
        }
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNovelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('novels', function ($table) {
            $table->integer('adult')->default(0)->unsigned()->index();
            $table->datetime('publish_reservation', 45)->nullable();
            $table->text('author_comment', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('novels', function ($table) {
            $table->dropColumn('adult');
            $table->dropColumn('publish_reservation');
            $table->dropColumn('author_comment');
        });
    }
}

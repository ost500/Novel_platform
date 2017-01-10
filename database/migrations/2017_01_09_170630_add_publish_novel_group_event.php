<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPublishNovelGroupEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publish_novel_groups', function (Blueprint $table) {
            $table->boolean('event')->default(false);
            $table->integer('initial_novels');
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
            $table->dropColumn('event');
            $table->dropColumn('initial_novels');
        });
    }
}

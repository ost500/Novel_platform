<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPublishNovelGroupsPublishAdult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publish_novel_groups', function (Blueprint $table) {
            $table->boolean('publish_adult')->default(0);
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
            $table->dropColumn('publish_adult');
        });
    }
}

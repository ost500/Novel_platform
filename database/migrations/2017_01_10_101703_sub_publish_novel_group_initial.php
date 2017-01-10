<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubPublishNovelGroupInitial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publish_novel_groups', function (Blueprint $table) {
            $table->dropColumn('days');
            $table->dropColumn('novels_per_days');
            $table->dropColumn('initial_novels');
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
            $table->integer('novels_per_days');
            $table->integer('days');
            $table->integer('initial_novels');
        });
    }
}

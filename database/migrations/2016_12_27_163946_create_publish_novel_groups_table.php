<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishNovelGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publish_novel_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('novel_group_id')->unsigned()->index();
            $table->integer('days')->unsigned();
            $table->integer('novels_per_days')->unsigned();
            $table->timestamps();

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
        Schema::dropIfExists('publish_novel_groups');
    }
}

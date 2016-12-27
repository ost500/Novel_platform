<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublishNovelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publish_novels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('novel_id')->unsigned()->index();
            $table->integer('publish_novel_group_id')->unsigned()->index();
            $table->enum('status', array('준비', '심사', '완료'));
            $table->string('file')->nullable();
            $table->timestamps();
            $table->foreign('novel_id')->references('id')->on('novels')->onDelete('cascade');
            $table->foreign('publish_novel_group_id')->references('id')->on('publish_novel_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publish_novels');
    }
}

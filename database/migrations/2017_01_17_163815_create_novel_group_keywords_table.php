<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovelGroupKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novel_group_keywords', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('novel_group_id')->unsigned()->index();
            $table->integer('keyword_id')->unsigned()->index();
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
        Schema::dropIfExists('novel_group_keywords');
    }
}

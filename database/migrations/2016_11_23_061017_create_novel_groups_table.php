<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovelGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novel_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('nickname');
            $table->string('title');
            $table->text('description');
            $table->string('keyword1');
            $table->string('keyword2');
            $table->string('keyword3');
            $table->string('keyword4');
            $table->string('keyword5');
            $table->string('keyword6');
            $table->string('keyword7');
            $table->string('cover_photo')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('novel_groups');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNovelGroupPublishCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novel_group_publish_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('publish_novel_group_id')->unsigned()->index();;
            $table->integer('company_id')->unsigned()->index();;
            $table->enum('status',array('신청하기','대기중','심사중','승인','거절'));
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('publish_novel_group_id')->references('id')->on('publish_novel_groups')->onDelete('cascade');
        });
    }

    /**s
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('novel_group_publish_companies');
    }
}

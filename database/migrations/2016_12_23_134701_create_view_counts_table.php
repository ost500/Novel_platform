<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_counts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('novel_id')->unsigned()->index();
            $table->date('date');
            $table->integer('count')->default(1);
            $table->integer('separation');
            $table->timestamps();
            $table->foreign('novel_id')->references('id')->on('novels')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_counts');
    }
}

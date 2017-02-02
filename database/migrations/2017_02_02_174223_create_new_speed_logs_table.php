<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewSpeedLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_speed_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('new_speed_id')->unsigned()->index();
            $table->foreign('new_speed_id')->references('id')->on('new_speeds')->onDelete('cascade');

            $table->boolean('read')->default(false);

            $table->timestamps();
        });
        Schema::table('new_speeds', function (Blueprint $table) {
            $table->dropColumn('read');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('new_speed_logs');
        Schema::table('new_speeds', function (Blueprint $table) {
            $table->boolean('read')->default(false);
        });
    }
}

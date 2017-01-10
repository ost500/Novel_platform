<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTodayDoneNovelGroupPublishCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('novel_group_publish_companies', function (Blueprint $table) {
            $table->boolean('today_done')->default(0)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('novel_group_publish_companies', function (Blueprint $table) {
            $table->dropColumn('today_done');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNovelsViewCounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('novels', function (Blueprint $table) {
            $table->integer('today_count')->unsigned()->default(0);
            $table->integer('week_count')->unsigned()->default(0);
            $table->integer('month_count')->unsigned()->default(0);
            $table->integer('year_count')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('novels', function (Blueprint $table) {
            $table->dropColumn('today_count');
            $table->dropColumn('week_count');
            $table->dropColumn('month_count');
            $table->dropColumn('year_count');

        });
    }
}

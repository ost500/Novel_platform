<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNgpcInitialData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('novel_group_publish_companies', function (Blueprint $table) {
            $table->integer('days')->unsigned()->nullable();
            $table->integer('novels_per_days')->unsigned()->nullable();
            $table->integer('initial_novels')->unsigned()->nullable();
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
            $table->dropColumn('days');
            $table->dropColumn('novels_per_days');
            $table->dropColumn('initial_novels');
        });
    }
}

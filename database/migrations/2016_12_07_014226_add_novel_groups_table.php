<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNovelGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('novel_groups', function ($table) {
            $table->integer('max_inning')->default(0)->unsigned()->index();
            $table->date('latest_at')->default(Carbon::now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('novel_groups', function ($table) {
            $table->dropColumn('max_inning');
            $table->dropColumn('latest_at');
        });
    }
}

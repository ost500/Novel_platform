<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNovelGroupsOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('novel_groups', function (Blueprint $table) {
            $table->boolean('completed')->default(0);
            $table->boolean('secret')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('novel_groups', function (Blueprint $table) {
            $table->dropColumn('completed');
            $table->dropColumn('secret');
        });
    }
}

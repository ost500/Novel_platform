<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNovelGroupsSoftdelete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('novel_groups', function (Blueprint $table) {
            $table->dropColumn('secret');
        });

        Schema::table('novel_groups', function (Blueprint $table) {
            $table->softDeletes();
            $table->dateTime('secret')->nullable();
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
            $table->dropColumn('deleted_at');
        });
    }
}

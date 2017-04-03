<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNGPCEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publish_novel_groups', function (Blueprint $table) {
            $table->dropColumn('event');
        });
        Schema::table('novel_group_publish_companies', function (Blueprint $table) {
            $table->boolean('event')->default(false);
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
            $table->dropColumn('event');
        });
        Schema::table('publish_novel_groups', function (Blueprint $table) {
            $table->boolean('event')->default(false);
        });
    }
}

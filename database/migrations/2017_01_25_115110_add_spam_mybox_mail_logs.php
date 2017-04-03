<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSpamMyboxMailLogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mail_logs', function (Blueprint $table) {
            $table->boolean('spam')->default(0);
            $table->boolean('mybox')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mail_logs', function (Blueprint $table) {
            $table->dropColumn('spam');
            $table->dropColumn('mybox');
        });
    }
}

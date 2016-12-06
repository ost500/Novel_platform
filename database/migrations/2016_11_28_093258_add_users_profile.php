<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('phone_num', 45)->nullable();
            $table->string('bank', 45)->nullable();
            $table->string('account_holder', 45)->nullable();
            $table->string('account_number', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('phone_num');
            $table->dropColumn('bank');
            $table->dropColumn('account_holder');
            $table->dropColumn('account_number');
        });
    }
}

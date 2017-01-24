<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('nickname')->nullable();
            $table->date('nickname_at')->nullable();
            $table->boolean('auth_email')->default(false);
            $table->boolean('auth_name')->default(false);
            $table->string('auth_meail_code')->nullable()->default(str_random(30));


            $table->boolean('comment_show')->default(true);
            $table->boolean('mail_available')->default(true);
            $table->boolean('event_mail_available')->default(true);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('auth_email');
            $table->dropColumn('auth_name');
            $table->dropColumn('auth_meail_code');
            $table->dropColumn('comment_show');
            $table->dropColumn('mail_available');
            $table->dropColumn('event_mail_available');
            $table->dropColumn('deleted_at');
        });
    }
}

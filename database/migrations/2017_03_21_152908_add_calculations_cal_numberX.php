<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCalculationsCalNumberX extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calculations', function (Blueprint $table) {
            $table->string('cal_numberX');
        });
        Schema::table('calculation_eaches', function (Blueprint $table) {
            $table->string('cal_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calculations', function (Blueprint $table) {
            $table->dropColumn('cal_numberX');
        });
        Schema::table('calculation_eaches', function (Blueprint $table) {
            $table->dropColumn('cal_number');
        });
    }
}

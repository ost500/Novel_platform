<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalculationEachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculation_eaches', function (Blueprint $table) {
            $table->increments('id');
            $table->text('data');
            $table->text('extra_data');

            $table->integer('calculation_id')->unsigned()->index();
            $table->foreign('calculation_id')->references('id')->on('calculations')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calculation_eaches');
    }
}

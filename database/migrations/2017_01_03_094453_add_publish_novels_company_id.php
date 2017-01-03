<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPublishNovelsCompanyId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('publish_novels', function (Blueprint $table) {
            $table->integer('company_id')->unsigned()->index()->after('publish_novel_group_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publish_novels', function (Blueprint $table) {
            $table->dropForeign('publish_novels_company_id_foreign');
            $table->dropColumn('company_id');
        });
    }
}

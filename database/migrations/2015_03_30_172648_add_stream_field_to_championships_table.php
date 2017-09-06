<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddStreamFieldToChampionshipsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('championships', function (Blueprint $table) {
            $table->string('stream')->after('token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('championships', function (Blueprint $table) {
            $table->dropColumn('stream');
        });
    }
}

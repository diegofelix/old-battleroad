<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCheckinToJoinsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('joins', function (Blueprint $table) {
            $table->boolean('checkin')->after('status_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('joins', function (Blueprint $table) {
            $table->dropColumn('checkin');
        });
    }
}

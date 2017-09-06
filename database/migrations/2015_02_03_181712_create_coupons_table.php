<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 11)->unique();
            $table->unsignedInteger('championship_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('join_id')->nullable();
            $table->unsignedInteger('price');
            $table->timestamps();
            $table->foreign('championship_id')->references('id')->on('championships');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('join_id')->references('id')->on('joins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('coupons');
    }
}

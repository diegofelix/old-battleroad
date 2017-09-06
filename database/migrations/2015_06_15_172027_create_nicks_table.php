<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNicksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('nicks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_id')->references('id')->on('items');
            $table->string('nick');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('nicks');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJoinsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('joins', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('championship_id');
			$table->unsignedInteger('status_id');
			$table->integer('price');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('championship_id')->references('id')->on('championships');
			$table->foreign('status_id')->references('id')->on('statuses');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('joins');
	}

}

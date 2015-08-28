<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWaitingListTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('waiting_list', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('user_id')->references('id')->on('users');
			$table->unsignedInteger('championship_id')->references('id')->on('championships');
			$table->unsignedInteger('competition_id')->references('id')->on('competitions');
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
		Schema::drop('waiting_list');
	}

}

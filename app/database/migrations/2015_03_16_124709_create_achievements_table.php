<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAchievementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('achievements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->unsignedInteger('championship_id');
			$table->unsignedInteger('competition_id');
			$table->unsignedInteger('position');
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('championship_id')->references('id')->on('championships');
			$table->foreign('competition_id')->references('id')->on('competitions');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('achievements');
	}

}

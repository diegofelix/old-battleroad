<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompetitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('competitions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('championship_id');
			$table->unsignedInteger('game_id');
			$table->unsignedInteger('platform_id');
			$table->unsignedInteger('format_id');
			$table->datetime('start');
			$table->integer('price')->unsigned();
			$table->integer('original_price')->unsigned();
			$table->integer('limit');
			$table->timestamps();

			$table->foreign('championship_id')
				->references('id')
				->on('championships')
				->onDelete('cascade');

			$table->foreign('game_id')->references('id')->on('games');
			$table->foreign('platform_id')->references('id')->on('platforms');
			$table->foreign('format_id')->references('id')->on('formats');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('competitions');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('join_id');
			$table->unsignedInteger('competition_id');
			$table->integer('price');
			$table->foreign('join_id')->references('id')->on('joins');
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
		Schema::drop('items');
	}

}

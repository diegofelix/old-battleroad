<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChampionshipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('championships', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->string('name', 200)->index();
			$table->text('description');
			$table->datetime('event_start');
			$table->string('image', 200);
			$table->string('thumb', 200);
			$table->string('location', 200);
			$table->string('token', 200);
			$table->boolean('published')->default(false)->index();
			$table->datetime('published_at');
			$table->boolean('finished')->default(false);
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('championships');
	}

}

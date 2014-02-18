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
			$table->integer('user_id');
			$table->string('name', 200);
			$table->text('description');
			$table->string('image', 200);
			$table->string('location', 200);
			$table->tinyInteger('published');
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
		Schema::drop('championships');
	}

}

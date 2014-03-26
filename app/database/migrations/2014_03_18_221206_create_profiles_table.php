<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->text('bio');
			$table->date('birthday');
			$table->string('cpf');
			$table->string('phone');
			$table->string('zipcode', 8);
			$table->string('address');
			$table->string('number');
			$table->string('complement');
			$table->string('state');
			$table->string('city');
			$table->timestamps();
			$table->foreign('user_id')
				->references('id')->on('users')
				->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('profiles');
	}

}

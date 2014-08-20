<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFieldsToJoinsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('joins', function(Blueprint $table)
		{
			$table->integer('status_id')->after('price');
			$table->string('token')->after('status_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('joins', function(Blueprint $table)
		{
			$table->dropColumn('status_id');
			$table->dropColumn('token');
		});
	}

}

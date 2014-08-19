<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddCancelationIdToJoinsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('joins', function(Blueprint $table)
		{
			$table->integer('cancelation_id')->after('status_id');
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
			$table->dropColumn('cancelation_id');
		});
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLimitToCompetitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('competitions', function(Blueprint $table)
		{
			$table->integer('limit')->nullable()->after('start');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('competitions', function(Blueprint $table)
		{
			$table->dropColumn('limit');
		});
	}

}

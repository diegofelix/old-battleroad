<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFinishedFieldToChampionshipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('championships', function(Blueprint $table)
		{
			$table->boolean('finished')->after('published');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('championships', function(Blueprint $table)
		{
			$table->dropColumn('finished');
		});
	}

}

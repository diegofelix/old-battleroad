<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRegisterEndsToChampionshipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('championships', function(Blueprint $table)
		{
			$table->dateTime('event_start')->after('location');
			$table->dateTime('event_end')->after('event_start');
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
			$table->dropColumn('event_start', 'event_end');
		});
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSegmentToChampionshipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('championships', function(Blueprint $table)
		{
			$table->integer('segment')->after('stream')->nullable();
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
			$table->dropColumn('segment');
		});
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveMoipUserFromProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('profiles', function(Blueprint $table)
		{
			$table->dropColumn('moip_user');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('profiles', function(Blueprint $table)
		{
			$table->string('moip_user')->after('steam');
		});
	}

}

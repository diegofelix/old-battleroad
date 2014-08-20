<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOriginalPriceToCompetitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('competitions', function(Blueprint $table)
		{
			$table->integer('original_price')->after('price');
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
			$table->dropColumn('original_price');
		});
	}

}

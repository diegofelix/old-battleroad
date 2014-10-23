<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('join_id');
			$table->unsignedInteger('transaction_id');
			$table->unsignedInteger('status_id')->default(1);
			$table->timestamps();
			$table->foreign('join_id')->references('id')->on('joins');
			$table->foreign('status_id')->references('id')->on('statuses');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transactions');
	}

}

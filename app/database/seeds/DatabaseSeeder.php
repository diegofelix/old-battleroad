<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UsersTableSeeder');
		$this->call('PlatformTableSeeder');
		$this->call('GameTableSeeder');
		$this->call('FormatTableSeeder');
		$this->call('StatusesTableSeeder');
		$this->call('PaymentTypesTableSeeder');
		$this->call('CancelationStatusesTableSeeder');
	}

}
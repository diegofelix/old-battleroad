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
		$this->call('FormatTableSeeder');
		$this->call('GameTableSeeder');
		$this->call('PlatformTableSeeder');
		$this->call('StatesTableSeeder');
	}

}
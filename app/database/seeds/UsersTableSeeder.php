<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		// create a real user to work with
		User::create([
			'name' => 'Diego Felix',
			'username' => 'diegofelix',
			'email' => 'diegoflx.oliveira@gmail.com',
			'password' => Hash::make('diegofelix'),
			'picture' => 'https://lh6.googleusercontent.com/-LfMmuv9QXh4/AAAAAAAAAAI/AAAAAAAAAOY/1wKOh84NVzM/s120-c/photo.jpg'
		]);

		// create more 9 fake users
		foreach(range(1, 9) as $index)
		{
			User::create([
				'name' => $faker->name,
				'username' => $faker->userName,
				'email' => $faker->email,
				'password' => Hash::make('default')
			]);
		}
	}

}

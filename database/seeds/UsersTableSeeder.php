<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Champ\Account\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // create a real user to work with
        User::create([
            'name' => 'Diego Felix',
            'username' => 'diegofelix',
            'email' => 'diegoflx.oliveira@gmail.com',
            'password' => Hash::make('diegofelix'),
            'picture' => 'https://lh6.googleusercontent.com/-LfMmuv9QXh4/AAAAAAAAAAI/AAAAAAAAAOY/1wKOh84NVzM/s120-c/photo.jpg',
            'is_organizer' => true,
        ]);
    }
}

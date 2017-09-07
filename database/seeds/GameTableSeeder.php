<?php

use Illuminate\Database\Seeder;

class GameTableSeeder extends Seeder {

    public function run()
    {
        DB::table('games')->insert([
            'name' => 'FIFA 2014',
            'icon' => 'images/games/fifa2014.jpg'
        ]);

        DB::table('games')->insert([
            'name' => 'STREET FIGHTER V',
            'icon' => 'images/games/sfv.jpg'
        ]);
    }

}
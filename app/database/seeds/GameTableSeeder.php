<?php

class GameTableSeeder extends Seeder {

    public function run()
    {
        DB::table('games')->insert([
            'name' => 'FIFA 2014',
            'icon' => 'images/games/fifa2014.jpg'
        ]);
         DB::table('games')->insert([
            'name' => 'SUPER STREET FIGHTER IV:ARCADE EDITION v.2012',
            'icon' => 'images/games/ssfivae.jpg'
        ]);

        DB::table('games')->insert([
            'name' => 'ULTRA STREET FIGHTER IV',
            'icon' => 'images/games/usfiv.jpg'
        ]);

        DB::table('games')->insert([
            'name' => 'ULTIMATE MARVEL VS CAPCOM 3',
            'icon' => 'images/games/umvc3.jpg'
        ]);

        DB::table('games')->insert([
            'name' => 'MORTAL KOMBAT',
            'icon' => 'images/games/mk.jpg'
        ]);

        DB::table('games')->insert([
            'name' => 'THE KING OF FIGHTERS XIII',
            'icon' => 'images/games/kofxiii.jpg'
        ]);

    }

}
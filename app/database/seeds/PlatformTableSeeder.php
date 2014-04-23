<?php

class PlatformTableSeeder extends Seeder {

    public function run()
    {
        DB::table('platforms')->insert([
            'name' => 'PS3',
            'icon' => 'images/platforms/ps3.jpg'
        ]);

        DB::table('platforms')->insert([
            'name' => 'XBOX 360',
            'icon' => 'images/platforms/xbox360.jpg'
        ]);

        DB::table('platforms')->insert([
            'name' => 'PC',
            'icon' => 'images/platforms/pc.jpg'
        ]);
    }

}
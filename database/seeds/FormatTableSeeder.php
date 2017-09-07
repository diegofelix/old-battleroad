<?php

use Illuminate\Database\Seeder;

class FormatTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('formats')->insert([
            'name' => 'Round Robin',
        ]);

        DB::table('formats')->insert([
            'name' => 'Double Elimination',
        ]);

        DB::table('formats')->insert([
            'name' => 'Single Elimination',
        ]);

        DB::table('formats')->insert([
            'name' => 'Swiss',
        ]);
    }
}

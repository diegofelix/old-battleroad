<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->call('UsersTableSeeder');
        $this->call('FormatTableSeeder');
        $this->call('GameTableSeeder');
        $this->call('PlatformTableSeeder');
        $this->call('StatusesTableSeeder');
    }
}

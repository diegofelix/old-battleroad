<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('username', 30)->unique()->index();
            $table->string('email', 80)->unique()->index();
            $table->string('password', 64);
            $table->string('picture', 200);
            $table->unsignedInteger('points');
            $table->boolean('is_banned')->default(false);
            $table->string('remember_token')->nullable();
            $table->boolean('is_organizer')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('users');
    }
}

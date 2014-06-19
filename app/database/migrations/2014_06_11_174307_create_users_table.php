<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->integer('role')->unsigned();
            $table->foreign('role')->references('id')->on('roles');
            $table->string('remember_token')->nullable();
            $table->timestamps();
        });

        $date = new \DateTime;
        DB::table('users')->insert([
            'email' => 'admin@admin.com',
            'password' => '$2y$10$wWGG3Bqv9bnt0FO78VhbkOb1dHwlM2rzju6WEPLmGVB5WojfNsANi',
            'role' => 1,
            'created_at' => $date,
            'updated_at' => $date
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function(Blueprint $table)
		{
			$table->integer('id')->unsigned()->primary();
			$table->string('role');
		});

        DB::table('roles')->insert([
            ['id' => 1, 'role' => 'admin'],
            ['id' => 2, 'role' => 'normal'],
            ['id' => 3, 'role' => 'restricted']
        ]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('roles');
	}

}

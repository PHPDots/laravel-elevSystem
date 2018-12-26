<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTncUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tnc_users', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('tnc_id')->index('tnc_id');
			$table->bigInteger('user_id')->index('user_id');
			$table->bigInteger('agree');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tnc_users');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTncUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tnc_users', function(Blueprint $table)
		{
			$table->foreign('tnc_id', 'tnc_users_ibfk_1')->references('id')->on('tncs')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('user_id', 'tnc_users_ibfk_2')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tnc_users', function(Blueprint $table)
		{
			$table->dropForeign('tnc_users_ibfk_1');
			$table->dropForeign('tnc_users_ibfk_2');
		});
	}

}

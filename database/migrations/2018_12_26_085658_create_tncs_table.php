<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTncsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tncs', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('title', 256);
			$table->text('terms');
			$table->dateTime('created');
			$table->dateTime('modified');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tncs');
	}

}

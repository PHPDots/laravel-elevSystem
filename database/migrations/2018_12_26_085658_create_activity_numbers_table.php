<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActivityNumbersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_numbers', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('type', 256);
			$table->string('area', 256)->nullable();
			$table->string('status', 256)->nullable();
			$table->bigInteger('activity_number');
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
		Schema::drop('activity_numbers');
	}

}

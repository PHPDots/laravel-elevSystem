<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAreaTimeSlotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('area_time_slots', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('area_id')->index('area_id');
			$table->string('time_slots', 32);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('area_time_slots');
	}

}

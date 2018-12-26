<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSystembookingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('systembookings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('booking_type', 30)->nullable();
			$table->integer('lesson_type')->nullable();
			$table->integer('user_id')->nullable();
			$table->integer('student_id')->nullable();
			$table->integer('city_id')->nullable();
			$table->dateTime('start_time')->nullable();
			$table->dateTime('end_time')->nullable();
			$table->text('note', 65535)->nullable();
			$table->char('status', 15)->default('pending');
			$table->string('g_cal_id', 200);
			$table->dateTime('created')->nullable();
			$table->dateTime('modified')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('systembookings');
	}

}

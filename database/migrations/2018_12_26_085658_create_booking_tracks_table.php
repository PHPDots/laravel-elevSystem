<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookingTracksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('booking_tracks', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('booking_id')->index('booking_id');
			$table->bigInteger('track_id')->index('track_id');
			$table->string('time_slot', 32)->index('time_slot');
			$table->bigInteger('student_id')->nullable()->index('student_id');
			$table->bigInteger('booking_user_id')->nullable();
			$table->string('number', 32)->nullable();
			$table->boolean('release_track')->default(0);
			$table->string('status', 10)->nullable();
			$table->boolean('is_edit')->default(0);
			$table->boolean('other_student')->nullable();
			$table->string('name', 30)->nullable();
			$table->string('address', 100)->nullable();
			$table->string('phone', 15)->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('zip_code', 50)->nullable();
			$table->string('city', 50)->nullable();
			$table->string('track_status', 32)->nullable();
			$table->dateTime('recent_realeased_tracks')->nullable();
			$table->bigInteger('course')->nullable();
			$table->bigInteger('released_by')->nullable();
			$table->string('g_cal_id', 200)->nullable();
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
		Schema::drop('booking_tracks');
	}

}

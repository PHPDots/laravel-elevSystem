<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBookingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookings', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('type', 32);
			$table->bigInteger('user_id')->index('user_id');
			$table->text('full_description')->nullable();
			$table->date('date');
			$table->string('area_slug', 32)->index('area_slug');
			$table->integer('on_behalf');
			$table->bigInteger('co_teacher')->nullable();
			$table->bigInteger('course')->nullable();
			$table->bigInteger('reference')->nullable();
			$table->boolean('reminder_sent')->nullable()->default(0);
			$table->integer('second_reminder_sent')->default(0);
			$table->integer('third_reminder_sent')->nullable()->default(0);
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
		Schema::drop('bookings');
	}

}

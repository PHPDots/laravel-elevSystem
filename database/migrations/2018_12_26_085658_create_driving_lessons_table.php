<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDrivingLessonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('driving_lessons', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('teacher_id');
			$table->bigInteger('student_id');
			$table->string('type', 12);
			$table->dateTime('start_time');
			$table->string('lesson_time', 10);
			$table->string('status', 12)->nullable();
			$table->string('module', 50);
			$table->text('comments', 65535);
			$table->string('approved', 3)->default('no');
			$table->string('activity_status', 256)->nullable();
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
		Schema::drop('driving_lessons');
	}

}

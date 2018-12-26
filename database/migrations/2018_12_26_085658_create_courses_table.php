<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('name', 256);
			$table->bigInteger('price');
			$table->string('teacher_time', 256);
			$table->string('activity_number', 256);
			$table->string('area', 256);
			$table->string('pre_selected', 32)->default('0');
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
		Schema::drop('courses');
	}

}

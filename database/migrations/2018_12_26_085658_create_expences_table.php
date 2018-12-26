<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExpencesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('expences', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('type', 256);
			$table->date('date');
			$table->string('price', 256);
			$table->integer('number');
			$table->bigInteger('student_id');
			$table->integer('tax');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('expences');
	}

}

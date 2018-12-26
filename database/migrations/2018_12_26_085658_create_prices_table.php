<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePricesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('prices', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->date('from_date');
			$table->string('type', 12);
			$table->string('name', 50)->nullable();
			$table->string('area', 50)->nullable();
			$table->integer('price');
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
		Schema::drop('prices');
	}

}

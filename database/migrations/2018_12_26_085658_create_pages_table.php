<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('category_code', 20)->nullable();
			$table->string('title', 100);
			$table->string('slug', 100);
			$table->text('body', 65535);
			$table->text('file', 65535);
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
		Schema::drop('pages');
	}

}

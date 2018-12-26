<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLiveEditsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('live_edits', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->default(0);
			$table->integer('entity_id');
			$table->date('date_selected');
			$table->char('location', 20);
			$table->char('time_slot', 20);
			$table->dateTime('created');
			$table->dateTime('modified');
			$table->char('form_type', 20);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('live_edits');
	}

}

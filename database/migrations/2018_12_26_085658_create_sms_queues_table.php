<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSmsQueuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sms_queues', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('mobileno', 256);
			$table->string('template', 256)->index('template');
			$table->text('data');
			$table->integer('priority')->default(1);
			$table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->string('status', 256)->default('inqueue');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sms_queues');
	}

}

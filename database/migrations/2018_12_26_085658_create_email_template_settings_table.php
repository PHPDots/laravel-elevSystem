<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmailTemplateSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_template_settings', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->string('name', 256);
			$table->string('template_type', 256);
			$table->text('body');
			$table->text('settings');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('email_template_settings');
	}

}

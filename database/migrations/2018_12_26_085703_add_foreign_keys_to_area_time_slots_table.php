<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAreaTimeSlotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('area_time_slots', function(Blueprint $table)
		{
			$table->foreign('area_id', 'area_time_slots_ibfk_1')->references('id')->on('areas')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('area_time_slots', function(Blueprint $table)
		{
			$table->dropForeign('area_time_slots_ibfk_1');
		});
	}

}

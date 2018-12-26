<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBookingTracksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('booking_tracks', function(Blueprint $table)
		{
			$table->foreign('track_id', 'booking_tracks_ibfk_2')->references('id')->on('tracks')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('booking_id', 'booking_tracks_ibfk_3')->references('id')->on('bookings')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('booking_tracks', function(Blueprint $table)
		{
			$table->dropForeign('booking_tracks_ibfk_2');
			$table->dropForeign('booking_tracks_ibfk_3');
		});
	}

}

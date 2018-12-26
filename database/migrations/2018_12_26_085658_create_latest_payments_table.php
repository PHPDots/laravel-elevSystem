<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLatestPaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('latest_payments', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('DebitorRegistreringID', 50);
			$table->string('IsPosteret', 10);
			$table->string('PosteringsDato', 50);
			$table->string('DebitorNummer', 20);
			$table->string('Debet', 20);
			$table->string('Kredit', 20);
			$table->string('BilagsNummer', 10);
			$table->string('ModKontoID', 50);
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('latest_payments');
	}

}

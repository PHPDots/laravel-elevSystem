<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigInteger('id', true);
			$table->bigInteger('avatar_id')->nullable()->default(0);
			$table->string('username', 256);
			$table->string('password', 256);
			$table->string('email_id', 256);
			$table->string('firstname', 256);
			$table->string('lastname', 256);
			$table->string('nick_name_user', 6)->nullable();
			$table->string('nick_name_company', 6)->nullable();
			$table->string('phone_no', 256);
			$table->string('role', 50)->index('role');
			$table->string('status', 256)->default('active');
			$table->string('activation_key', 256)->nullable();
			$table->string('student_number', 20)->nullable();
			$table->string('company', 256)->nullable();
			$table->string('company_id', 6);
			$table->string('address', 50)->nullable();
			$table->string('zip', 10)->nullable();
			$table->string('city', 30)->nullable();
			$table->string('other_phone_no', 15)->nullable();
			$table->date('date_of_birth')->nullable();
			$table->integer('balance')->nullable();
			$table->string('credit_max', 32);
			$table->string('available_balance', 50);
			$table->decimal('last_balance', 15)->default(0.00);
			$table->date('last_entry_for_balance')->nullable();
			$table->bigInteger('teacher_id')->nullable();
			$table->string('crm_id', 256)->nullable();
			$table->string('assistent_id', 50)->nullable();
			$table->boolean('handed_firstaid_papirs')->default(0);
			$table->date('firstaid_papirs_date');
			$table->boolean('theory_test_passed')->default(0);
			$table->string('student_medical_profile', 32)->nullable();
			$table->string('google_token', 150)->nullable();
			$table->boolean('is_login_firsttime')->default(1);
			$table->integer('is_completed')->nullable()->default(0);
			$table->date('expiry_date')->nullable();
			$table->dateTime('created');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailConfirmation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('users', function($table) {
			$table->string('confirmation_code');
			$table->boolean('confirmed')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::table('users', function($table) {
		    $table->dropColumn('confirmation_code');
		    $table->dropColumn('confirmed');
		});
	}

}

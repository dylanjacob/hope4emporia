<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddStartAndEndTimeToEvntsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('evnts', function(Blueprint $table)
		{
			$table->string('starttime');
			$table->integer('duration');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('evnts', function(Blueprint $table)
		{
			$table->dropColumn('starttime', 'duration');		
		});
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddScheduleIdToEvntTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('evnts', function(Blueprint $table)
		{
			$table->integer('schedule_id');
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
			$table->dropColumn('schedule_id');
		});
	}

}

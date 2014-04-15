<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPubdateColumnToSermonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sermons', function(Blueprint $table)
		{
			$table->date('pubdate');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sermons', function(Blueprint $table)
		{
			$table->dropColumn('pubdate');
		});
	}

}

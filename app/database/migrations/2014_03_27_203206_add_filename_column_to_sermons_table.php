<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFilenameColumnToSermonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sermons', function(Blueprint $table)
		{
			$table->string('filename', 128)->unique();	
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
			$table->dropColumn('filename');
		});
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddPodcastFieldsToSermonsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sermons', function(Blueprint $table)
		{
			$table->string('image_url')->nullable();
			$table->binary('summary')->nullable();
			$table->binary('subtitle')->nullable();
			$table->binary('description')->nullable();
			$table->integer('length');
			$table->string('detail_url');
			$table->time('duration');
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
			$table->dropColumn('image_url', 'summary', 'subtitle', 'description', 'length', 'detail_url', 'duration');
		});
	}

}

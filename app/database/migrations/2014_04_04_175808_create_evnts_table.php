<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvntsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evnts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->date('evntdate');
			$table->string('author');
			$table->string('location');
			$table->date('pubdate');
			$table->boolean('enabled');
			$table->binary('description');
			$table->string('image');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('evnts');
	}

}

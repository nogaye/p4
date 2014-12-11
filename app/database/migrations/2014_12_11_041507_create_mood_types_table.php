<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoodTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mood_types', function($table) {

			# AI, PK
			$table->increments('id');
			
			
			# General data...
			$table->string('name');			
			$table->string('description');

			# created_at, updated_at columns
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
		Schema::drop('mood_types');
	}

}

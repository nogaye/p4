<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('moods', function($table) {

			# AI, PK
			$table->increments('id');
			
			
			# General data...			
			$table->integer('user_id')->unsigned(); # Important! FK has to be unsigned because the PK it will reference is auto-incrementing		
			$table->integer('mood_type_id')->unsigned(); # Important! FK has to be unsigned because the PK it will reference is auto-incrementing	
			$table->string('mood');		
			$table->string('lat');
			$table->string('lng');
			
			# Define foreign keys...
			$table->foreign('mood_type_id')->references('id')->on('mood_types');
			$table->foreign('user_id')->references('id')->on('users');

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
		Schema::drop('moods');
	}

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessages1sTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//create table
		Schema::create('messages1s', function(Blueprint $table)
		{
			//add columns
			$table->increments('messageid');
			$table->string('to');
			$table->string('message');
			$table->string('from');
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
		Schema::drop('messages1s');
	}

}

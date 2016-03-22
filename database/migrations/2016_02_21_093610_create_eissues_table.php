<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEissuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//create table
		Schema::create('eissues', function(Blueprint $table)
		{
			//add columns
			$table->increments('eID');
			$table->string('emailFrom');
			$table->string('subject');
			$table->string('message');
			$table->string('description');
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
		Schema::drop('eissues');
	}

}

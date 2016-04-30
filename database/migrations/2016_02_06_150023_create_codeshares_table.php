<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodesharesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//create table
		Schema::create('codeshares', function(Blueprint $table)
		{
			//ad columns
			$table->increments('codeId');
			$table->string('userName');
			$table->string('title');
			$table->string('language');
			$table->string('description');
			$table->string('sourceCode');

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
		Schema::drop('codeshares');
	}

}

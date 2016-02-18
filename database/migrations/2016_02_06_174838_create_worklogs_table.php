<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorklogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('worklogs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('story_id');
			$table->string('user_id');
			$table->date('work_start_date');
			$table->date('work_end_date');
			$table->string('description');
			$table->float('duration');
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
		Schema::drop('worklogs');
	}

}

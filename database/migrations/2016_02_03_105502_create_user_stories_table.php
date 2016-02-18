<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserStoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_stories', function(Blueprint $table)
		{
			$table->string('story_id');
			$table->string('project_id');
			$table->string('summary');
			$table->string('priority');
			$table->string('assignee');
			$table->date('due_date');
			$table->string('reporter');
			$table->string('description');
			$table->string('org_est');

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
		Schema::drop('user_stories');
	}

}

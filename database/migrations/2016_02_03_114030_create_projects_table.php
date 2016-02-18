<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{

			$table->string('default')->default('P');
			$table->increments('ProjectID');
			$table->string('ProjectName');
			$table->string('Description');
			$table->string('State');
			$table->string('Hide')->default('off');
			$table->date('add_date');
			$table->date('due_date');
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
		Schema::drop('projects');
	}

}

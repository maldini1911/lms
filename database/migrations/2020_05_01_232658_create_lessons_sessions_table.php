<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLessonsSessionsTable extends Migration {

	public function up()
	{
		Schema::create('lessons_sessions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('video')->nullable();
			$table->string('url-video')->nullable();
			$table->integer('lesson_id')->unsigned()->nullable();
			$table->integer('session_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('lessons_sessions');
	}
}
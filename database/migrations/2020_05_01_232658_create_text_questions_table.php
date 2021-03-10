<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTextQuestionsTable extends Migration {

	public function up()
	{
		Schema::create('text_questions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('question');
			$table->string('answer');
			$table->integer('mark')->nullable();
			$table->integer('subject_id')->unsigned();
			$table->integer('member_id')->unsigned()->nullable();
			$table->enum('position', array('assignment', 'quize'));
		});
	}

	public function down()
	{
		Schema::drop('text_questions');
	}
}
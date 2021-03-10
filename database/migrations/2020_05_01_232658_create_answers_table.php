<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnswersTable extends Migration {

	public function up()
	{
		Schema::create('answers', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('answer');
			$table->integer('text_question_id')->unsigned()->nullable();
			$table->integer('question_choice_id')->unsigned()->nullable();
			$table->integer('true_false_id')->unsigned()->nullable();
			$table->integer('image_true_fase_id')->unsigned()->nullable();
			$table->string('assignment_code')->nullable();
			$table->string('quize_code');
			$table->integer('student_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('answers');
	}
}
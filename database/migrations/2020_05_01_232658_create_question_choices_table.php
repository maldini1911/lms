<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionChoicesTable extends Migration {

	public function up()
	{
		Schema::create('question_choices', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->string('question');
			$table->string('first_choice');
			$table->string('second_choice');
			$table->string('third_choice');
			$table->string('fourth_choice');
			$table->string('answer');
			$table->integer('subject_id')->unsigned()->nullable();
			$table->integer('member_id')->unsigned();
			$table->enum('position', array('assignment', 'quize'));
			$table->integer('mark')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('question_choices');
	}
}
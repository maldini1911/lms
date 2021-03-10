<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImageTrueFaseTable extends Migration {

	public function up()
	{
		Schema::create('image_true_fase', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title')->nullable();
			$table->string('question');
			$table->enum('true', array('yes'))->nullable();
			$table->enum('false', array('no'))->nullable();
			$table->enum('answer', array('yes', 'no'))->nullable();
			$table->integer('subject_id')->unsigned();
			$table->integer('member_id')->unsigned();
			$table->enum('position', array('assignment', 'quize'));
			$table->integer('mark')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('image_true_fase');
	}
}
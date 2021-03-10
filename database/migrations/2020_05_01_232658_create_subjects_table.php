<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubjectsTable extends Migration {

	public function up()
	{
		Schema::create('subjects', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->enum('type', array('Applied', 'Theory'));
			$table->integer('term_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('subjects');
	}
}
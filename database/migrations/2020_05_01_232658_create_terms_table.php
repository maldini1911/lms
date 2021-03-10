<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTermsTable extends Migration {

	public function up()
	{
		Schema::create('terms', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('academic_year');
			$table->string('term');
			$table->integer('faculty_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('terms');
	}
}
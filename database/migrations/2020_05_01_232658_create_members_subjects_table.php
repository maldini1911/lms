<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembersSubjectsTable extends Migration {

	public function up()
	{
		Schema::create('members_subjects', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('member_id')->unsigned();
			$table->integer('subject_id')->unsigned();
			$table->char('from', 10);
			$table->char('to', 10);
			$table->char('day', 10);
		});
	}

	public function down()
	{
		Schema::drop('members_subjects');
	}
}
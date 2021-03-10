<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembersTable extends Migration {

	public function up()
	{
		Schema::create('members', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email')->nullable();
			$table->string('password');
			$table->char('mobile', 20)->nullable();
			$table->integer('code')->unique()->nullable();
			$table->enum('position', array('student', 'doctor', 'teacher'));
		});
	}

	public function down()
	{
		Schema::drop('members');
	}
}
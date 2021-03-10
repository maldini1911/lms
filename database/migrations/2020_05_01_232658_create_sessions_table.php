<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSessionsTable extends Migration {

	public function up()
	{
		Schema::create('sessions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title')->nullable();
			$table->string('desc')->nullable();
			$table->integer('member_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('sessions');
	}
}
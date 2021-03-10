<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAttendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_attends', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('student_profiles_id');
            $table->integer('lecture_id');
            $table->integer('member_id');
            $table->integer('lesson_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_attends');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('terms', function(Blueprint $table) {
			$table->foreign('faculty_id')->references('id')->on('faculties')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('subjects', function(Blueprint $table) {
			$table->foreign('term_id')->references('id')->on('terms')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('members_subjects', function(Blueprint $table) {
			$table->foreign('member_id')->references('id')->on('members')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('members_subjects', function(Blueprint $table) {
			$table->foreign('subject_id')->references('id')->on('subjects')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('lessons', function(Blueprint $table) {
			$table->foreign('member_id')->references('id')->on('members')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('sessions', function(Blueprint $table) {
			$table->foreign('member_id')->references('id')->on('members')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('lessons_sessions', function(Blueprint $table) {
			$table->foreign('course_id')->references('id')->on('lessons')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('lessons_sessions', function(Blueprint $table) {
			$table->foreign('session_id')->references('id')->on('sessions')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('text_questions', function(Blueprint $table) {
			$table->foreign('subject_id')->references('id')->on('subjects')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('text_questions', function(Blueprint $table) {
			$table->foreign('member_id')->references('id')->on('members')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('question_choices', function(Blueprint $table) {
			$table->foreign('subject_id')->references('id')->on('subjects')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('question_choices', function(Blueprint $table) {
			$table->foreign('member_id')->references('id')->on('members')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('true_false', function(Blueprint $table) {
			$table->foreign('subject_id')->references('id')->on('subjects')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('true_false', function(Blueprint $table) {
			$table->foreign('member_id')->references('id')->on('members')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('image_true_fase', function(Blueprint $table) {
			$table->foreign('subject_id')->references('id')->on('subjects')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('image_true_fase', function(Blueprint $table) {
			$table->foreign('member_id')->references('id')->on('members')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('answers', function(Blueprint $table) {
			$table->foreign('text_question_id')->references('id')->on('text_questions')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('answers', function(Blueprint $table) {
			$table->foreign('question_choice_id')->references('id')->on('question_choices')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('answers', function(Blueprint $table) {
			$table->foreign('true_false_id')->references('id')->on('true_false')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('answers', function(Blueprint $table) {
			$table->foreign('image_true_fase_id')->references('id')->on('image_true_fase')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('answers', function(Blueprint $table) {
			$table->foreign('student_id')->references('id')->on('members')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('terms', function(Blueprint $table) {
			$table->dropForeign('terms_faculty_id_foreign');
		});
		Schema::table('subjects', function(Blueprint $table) {
			$table->dropForeign('subjects_term_id_foreign');
		});
		Schema::table('members_subjects', function(Blueprint $table) {
			$table->dropForeign('members_subjects_member_id_foreign');
		});
		Schema::table('members_subjects', function(Blueprint $table) {
			$table->dropForeign('members_subjects_subject_id_foreign');
		});
		Schema::table('lessons', function(Blueprint $table) {
			$table->dropForeign('lessons_member_id_foreign');
		});
		Schema::table('sessions', function(Blueprint $table) {
			$table->dropForeign('sessions_member_id_foreign');
		});
		Schema::table('lessons_sessions', function(Blueprint $table) {
			$table->dropForeign('lessons_sessions_lesson_id_foreign');
		});
		Schema::table('lessons_sessions', function(Blueprint $table) {
			$table->dropForeign('lessons_sessions_session_id_foreign');
		});
		Schema::table('text_questions', function(Blueprint $table) {
			$table->dropForeign('text_questions_subject_id_foreign');
		});
		Schema::table('text_questions', function(Blueprint $table) {
			$table->dropForeign('text_questions_member_id_foreign');
		});
		Schema::table('question_choices', function(Blueprint $table) {
			$table->dropForeign('question_choices_subject_id_foreign');
		});
		Schema::table('question_choices', function(Blueprint $table) {
			$table->dropForeign('question_choices_member_id_foreign');
		});
		Schema::table('true_false', function(Blueprint $table) {
			$table->dropForeign('true_false_subject_id_foreign');
		});
		Schema::table('true_false', function(Blueprint $table) {
			$table->dropForeign('true_false_member_id_foreign');
		});
		Schema::table('image_true_fase', function(Blueprint $table) {
			$table->dropForeign('image_true_fase_subject_id_foreign');
		});
		Schema::table('image_true_fase', function(Blueprint $table) {
			$table->dropForeign('image_true_fase_member_id_foreign');
		});
		Schema::table('answers', function(Blueprint $table) {
			$table->dropForeign('answers_text_question_id_foreign');
		});
		Schema::table('answers', function(Blueprint $table) {
			$table->dropForeign('answers_question_choice_id_foreign');
		});
		Schema::table('answers', function(Blueprint $table) {
			$table->dropForeign('answers_true_false_id_foreign');
		});
		Schema::table('answers', function(Blueprint $table) {
			$table->dropForeign('answers_image_true_fase_id_foreign');
		});
		Schema::table('answers', function(Blueprint $table) {
			$table->dropForeign('answers_student_id_foreign');
		});
	}
}

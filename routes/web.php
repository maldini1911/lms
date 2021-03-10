<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::pattern('id', '[0-9]+');

Route::group(['namespace' => 'BackEnd', 'prefix' => 'admin', 'middleware' => ['admin']], function(){
   Route::get('logout', 'publicAdmin@logout_admin');
    Route::get('dashboard', 'publicAdmin@dashboard');
    Route::resource('users', 'Users');
    //==================
    Route::resource('doctors', 'Doctors');
    Route::any('doctors/delete/all', 'Doctors@multi_delete');
    Route::post('doctor/excel', 'ImportExcelController@importDoctor');
    Route::any('filter/squads/doctors/{id}', 'Doctors@filter_squads');
    //===================
    Route::resource('students', 'Students');
    Route::any('students/delete/all', 'Students@multi_delete');
    Route::post('students/excel', 'ImportExcelController@importStudent');
    Route::any('filter/squads/students/{id}', 'Students@filter_squads');


    Route::resource('universities', 'Universities');
    Route::resource('faculties', 'Faculties');
    Route::resource('terms', 'Terms');
    Route::resource('specialties', 'Specialties');
    Route::get('specialties/show/{id}', 'Specialties@show_department');

    Route::resource('courses', 'Courses');
    Route::any('filter/data/{id}', 'Courses@filter_squads');
    Route::any('terms/filter/data/{id}', 'Courses@filter_terms');
    Route::any('subjects/show/{id}', 'Courses@show');
    Route::get('subjects/delete/all', 'Courses@multi_delete');
    Route::get('treeview', 'publicAdmin@treeviewAdmin');
    //====================================================================
    Route::get('coursedoctors', 'CourseDoctors@index');
    Route::get('coursedoctors/create/{id}', 'CourseDoctors@create');
    Route::post('coursedoctors/store', 'CourseDoctors@store');
    Route::get('coursedoctors/edit/{id}', 'CourseDoctors@edit');
    Route::get('coursedoctors/show/{id}', 'CourseDoctors@show');
    Route::put('coursedoctors/update/{id}', 'CourseDoctors@update');
    Route::any('coursedoctors/delete/{id}', 'CourseDoctors@delete');
    //====================================================================
    Route::get('setting', 'SettingAdmins@index');
    Route::any('setting/update/{id}', 'SettingAdmins@update');
    //===============================================================
    //===== || Reports Admin ||
    Route::get('reports/marks/assignments', 'ReportsAdminController@report_results_assignment');
    Route::get('reports/marks/quizes', 'ReportsAdminController@report_results_quize');
    Route::get('reports/attends/students', 'ReportsAdminController@report_attends_student');
    //=========
    Route::any('fiter/squads/{id}', 'FilterSquads@filter_squads');

});
Route::any('data/all/user2', "Controller@get_profile");
Route::group(['namespace' => 'BackEnd', 'prefix' => 'doctors', 'middleware' => ['doctors']], function(){
    //====> Lectures Area
    Route::get('dashboard', 'publicAdmin@dashboard');
    Route::get('course', 'DoctorCourses@course');
    Route::resource('lectures', 'Lectures');
    Route::get('lectures/view/{id}', 'Lectures@lecture_view');
    Route::get('lectures/attachment/{id}', 'Lectures@lecture_attachment');
    Route::post('lectures/url/edit/{id}', 'Lectures@edit_url');
    Route::any('lectures/url/delete/{id}', 'Lectures@delete_url');
    Route::post('lectures/video/edit/{id}', 'Lectures@edit_video');
    Route::any('lectures/video/delete/{id}', 'Lectures@delete_video');
    Route::post('lectures/image/edit/{id}', 'Lectures@edit_image');
    Route::any('lectures/image/delete/{id}', 'Lectures@delete_image');
    Route::get('show/interactive/sessions', 'Lectures@show_interactive_sessions');
    Route::post('store/interactive/sessions', 'Lectures@store_interactive_sessions');
    Route::any('lectures/delete/all', 'Lectures@multi_delete');
    //====> Lessons Area
    Route::resource('lessons', 'Lessons');
    Route::get('lessons/create/{id?}', 'Lessons@create');
    Route::get('view/lessons/{id}', 'Lessons@lesson_view');
    Route::get('lessons/attachment/{id}', 'Lessons@lesson_attachment');
    Route::post('lessons/url/edit/{id}', 'Lessons@edit_url');
    Route::any('lessons/url/delete/{id}', 'Lessons@delete_url');
    Route::post('lessons/video/edit/{id}', 'Lessons@edit_video');
    Route::any('lessons/video/delete/{id}', 'Lessons@delete_video');
    Route::post('lessons/image/edit/{id}', 'Lessons@edit_image');
    Route::any('lessons/image/delete/{id}', 'Lessons@delete_image');
    Route::any('lessons/delete/all', 'Lessons@multi_delete');
    //====> Assignments Area
    Route::get('assignments/{id?}', 'Assignments@index');
    Route::get('assignments/create', 'Assignments@create');
    Route::post('assignments/store', 'Assignments@store');
    Route::get('assignments/view/{id}', 'Assignments@show');
    Route::get('assignments/edit/{id}', 'Assignments@edit');
    Route::post('assignments/update/{id}', 'Assignments@assignment_update');

    Route::get('assignments/question/delete/{id}', 'Assignments@assignment_question_delete');
    Route::post('assignments/questions/update/{id}', 'Assignments@assignment_question_update');
    Route::any('assignment/delete/{id}', 'Assignments@destroy');
    Route::any('assignments/delete/all', 'Assignments@multi_delete');
    Route::get('assignments/edit/image/answers/{id}', 'Assignments@edit_image_answers');
    Route::get('assignments/all/answers/{id}/{as}', 'Assignments@student_answers');
    Route::get('assignments/view/answers/{id}', 'Assignments@view_answers');
    Route::any('assignments/post/edit/image/{id}', 'Assignments@update_answer_image');

     //====> Quizes Area
    Route::get('quizes/{id?}', 'Quizes@index');
    Route::get('quizes/create', 'Quizes@create');
    Route::post('quizes/store', 'Quizes@store');
    Route::get('quizes/view/{id}', 'Quizes@show');
    Route::get('quizes/edit/{id}', 'Quizes@edit');
    Route::post('quizes/update/{id}', 'Quizes@quize_update');
    Route::post('quizes/question/update/{id}', 'Quizes@quize_question_update');
    Route::any('quizes/delete/{id}', 'Quizes@destroy');
    Route::any('quizes/delete/all', 'Quizes@multi_delete');
    Route::get('quizes/show/answers/{id}', 'Quizes@show_answers');
    Route::get('quizes/all/answers/{id}/{qz}', 'Quizes@student_answers');
    Route::get('quizes/view/answers/{id}', 'Quizes@view_answers');
    Route::any('quizes/post/edit/image/{id}', 'Quizes@update_answer_image');
    //=====> Action Attachment

    Route::get('attachment/view/edit/{id}', 'Attachments@edit_attachment');
    Route::post('attachment/edit/{id}', 'Attachments@update_attachment');
    Route::any('attachment/delete/{id}', 'Attachments@delete_attachment');

    //========== Projects =====
    Route::get('projects', 'Projects@index');
    Route::get('projects/create', 'Projects@create');
    Route::get('projects/edit', 'Projects@edit');
    Route::get('projects/detailes', 'Projects@detailes');
    //====================================================================
    Route::post('questions/bulck', 'ImportExcelController@importQuestions');
    //====================================================================
      Route::get('setting/{id}', 'publicAdmin@setting_doctor');
      Route::post('setting/update/{id}', 'publicAdmin@setting_doctor_update');
    //====================================================================
    Route::get('logout', 'publicAdmin@logout_doctor');
    Route::get('reports/marks/assignments', 'ReportsDoctorController@report_results_assignment');
    Route::get('reports/marks/quizes', 'ReportsDoctorController@report_results_quize');
    Route::get('reports/attends/students', 'ReportsDoctorController@report_attends_student');

});



Route::group(['namespace' => 'FrontEnd'], function(){
        Route::get('home', 'BackEnd/publicAdmin@dashboard');
        Route::get('/', 'FrontEnd@index');
        Route::get('login', 'Login@login');
        Route::post('login', 'Login@login_post');
        Route::get('logout', 'Login@logout_student');
        Route::any('data/all', "StudentsController@student_get_profile");
Route::group(['middleware' => ['students']], function(){

        Route::get('home', 'FrontEnd@dashboard');
        Route::get('doctor/subjects', 'StudentsController@doctor_subjects');
        Route::get('courses', 'StudentsController@student_subjects');
        Route::get('detailes/doctors', "StudentsController@doctor_subjects");
        Route::get('lectures/{id?}', 'StudentsController@lectures');
        Route::get('view/lecture/{id}', 'StudentsController@lecturesView');
        Route::get('details/lecture/{id}', 'StudentsController@lectureDetailes');
        //Route::get('details/lecture/out/{id}', 'Student@lectureOut')
        //=========================
        Route::get('lessons/{id?}/{course?}', 'StudentsController@lessons');
        Route::get('view/lessons/{id}', 'StudentsController@lessonsView');
        Route::get('details/lesson/{id}', 'StudentsController@lessonDetailes');
        //=========================
        Route::get('attachment/{id}', 'StudentsController@attachments');
        //=========================
        Route::get('assignment', 'StudentsController@assignments');
        Route::get('view/assignment/{id}', 'StudentsController@view_assignment');
        Route::any('answers/assignment/question', 'StudentsController@answers_assignments_questions');
        Route::any('assignment/result', 'StudentsController@assignments_result');
        Route::get('report/assignment/{id}', 'StudentsController@report_assignment');
        //========================
        Route::get('quizes', 'StudentsController@quizes');
        Route::get('view/quize/{id}', 'StudentsController@view_quize');
        Route::any('answers/quize/question', 'StudentsController@answers_quizes_questions');
        Route::any('quize/result', 'StudentsController@quizes_result');
        //=========================
        Route::any('attend/lecture/{id}', 'FrontEnd@interactive_session_attend_lecture');

        Route::get('show/interacitve/sessions', 'StudentsController@show_interactive_sessions');

        Route::get('view/interactive/seesions/{id}', 'StudentsController@view_interactive_sessions');
        //=========================

        Route::get('setting/{id}', 'StudentsController@setting_student');
        Route::post('setting/update/{id}', 'StudentsController@setting_student_update');

        //===========|| Reports Student ||
        Route::get('report/results/assignments', 'ReportsStudentController@report_results_assignment');
        Route::get('report/results/quizes', 'ReportsStudentController@report_results_quize');

      //========|| Student Attends Lectures
      Route::get('logout/lecture/student/{id}', 'ReportsStudentController@logout_lecture');

});
});

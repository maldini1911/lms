<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Models\InteractiveSessionAttend;
use App\Models\Doctor;
use App\Models\Student;
use App\Models\Specialty;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Lesson;
use App\Models\Term;
use App\Models\Assignment;
use App\Models\Quize;
use App\Models\CourseDoctor;
use App\Models\DepardmentTerm;
use App\Models\StudentTerm;
use App\User;
use Auth;


class FrontEnd extends Controller
{

    public function index()
    {
        return view('Design.home');
    }

    //==> Get Dashboard Admin
    public function dashboard()
    {

       if(auth()->guard('student')->check())
       {
           //==== Dashborad Doctor
           $doctor = Doctor::where('term_id', auth()->guard('student')->user()->term_id)->count();
           $term = StudentTerm::where('student_id', auth()->guard('student')->user()->id)->first();
           $course = Course::where('term_id', $term->term_id)->count();

           $lecture_student = Lecture::whereHas('doctor', function($query){
             $query->where('term_id', auth()->guard('student')->user()->term_id);
           })->where('lecture_status', 'publish')->count();

           $lesson_student = Lesson::whereHas('doctor', function($query){
             $query->where('term_id', auth()->guard('student')->user()->term_id);
           })->where('lesson_status', 'publish')->count();

           $assignment_student = Assignment::whereHas('doctor', function($query){
             $query->where('term_id', auth()->guard('student')->user()->term_id);
           })->count();

           $quize_student = Quize::whereHas('doctor', function($query){
             $query->where('term_id', auth()->guard('student')->user()->term_id);
           })->count();


          $rows = CourseDoctor::whereHas('doctor', function($query){
              $query->where('term_id', auth()->guard('student')->user()->term_id);
          })->where('academic_year', date('Y'))->get();

           return view('Admin.dashboard', compact(
               'doctor', 'course', 'lecture_student', 'lesson_student', 'assignment_student', 'quize_student', 'rows'
           ));
       }

    }

    public function interactive_session_attend_lecture($id)
    {
      $check_attend_lecture = InteractiveSessionAttend::where('lecture_id')->first();

      if(!$check_attend_lecture)
      {
          dd("Yes");
      }
    }

}

<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\reset_password;
use App\Models\University;
use App\Models\CourseDoctor;
use App\Models\Doctor;
use App\Models\Term;
use App\Models\Student;
use App\Models\Specialty;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Lesson;
use App\Models\Assignment;
use App\Models\Quize;
use App\Models\Faculty;
use Carbon\Carbon;
use App\User;
use Session;
use Mail;
use Auth;
use DB;
use File;

class publicAdmin extends Controller
{

     //==> Get Dashboard Admin
     public function dashboard()
     {

        if(auth()->guard('web')->check())
        {
            //=== Dashborad Admin
            $university = University::count();
            $doctor = Doctor::count();
            $student = Student::count();
            $faculty = Faculty::count();
            $course = Course::count();

            return view('Admin.dashboard', compact(
                'university', 'doctor', 'student', 'faculty', 'course'
            ));
        }


        if(auth()->guard('doctor')->check())
        {
            //==== Dashborad Doctor
            $lecture = Lecture::where('doctor_id', auth()->guard('doctor')->user()->id)->where('lecture_status', 'publish')->count();
            $lesson = Lesson::where('doctor_id', auth()->guard('doctor')->user()->id)->where('lesson_status', 'publish')->count();
            $assignment = Assignment::where('doctor_id', auth()->guard('doctor')->user()->id)->count();
            $quize = Quize::where('doctor_id', auth()->guard('doctor')->user()->id)->count();

            $courses_doctor = CourseDoctor::whereHas('doctor', function($query){
              $query->where('doctor_id', auth()->guard('doctor')->user()->id);
            })->count();

            $courses_doctor_now = CourseDoctor::whereHas('doctor', function($query){
              $query->where('doctor_id', auth()->guard('doctor')->user()->id)
              ->where('academic_year', date('Y'));
            })->count();

            $rows = CourseDoctor::where('doctor_id', auth()->guard('doctor')->user()->id)->where('academic_year', date('Y'))->get();

            return view('Admin.dashboard', compact(
                'lecture', 'lesson', 'assignment', 'quize', 'courses_doctor', 'courses_doctor_now', 'rows'
            ));
        }


        if(auth()->guard('student')->check())
        {
          //==== Dashborad Doctor
          $doctor = Doctor::where('term_id', auth()->guard('student')->user()->term_id)->count();
          $term = Term::where('id', auth()->guard('student')->user()->id)->first();
          $deparmtent =  Specialty::where('term_id', $term->id)->first();
          $course = Course::where('specialty_id', $deparmtent->id)->count();

          $lecture_student = Lecture::whereHas('doctor', function($query){
            $query->where('term_id', auth()->guard('student')->user()->term_id);
          })->count();

          $lesson_student = Lesson::whereHas('doctor', function($query){
            $query->where('term_id', auth()->guard('student')->user()->term_id);
          })->count();


          return view('Admin.dashboard', compact(
              'doctor', 'course', 'lecture_student', 'lesson_student'
          ));
        }


     }

     public function treeviewAdmin()
     {
        $rows = University::all();
         return view('Admin.treeview_admin', compact('rows'));
     }


     public function logout_doctor()
     {
         auth()->guard('doctor')->logout();
         return redirect('login');
     }


     public function logout_admin(Request $request){
         auth()->guard('web')->logout();
         return redirect('login');
     }


     public function setting_doctor($id)
     {

       $row = Doctor::where('id', $id)->first();
       return view('Admin.setting_doctor', compact('row'));
     }


      public function setting_doctor_update(Request $request, $id)
     {
       $data = $this->validate(request(), [
           'email'                     => 'required|string|email|unique:doctors,email,'.$id,
           'password'                  => 'sometimes|nullable|string',
           'mobile'                    => 'sometimes|nullable',
           'interactive_sessions'      => 'sometimes|nullable',
           'image'                     =>  validate_image(),
       ]);


       $img = Doctor::find($id)->first();
       if(request()->hasFile('image'))
       {
           $file = $request->file('image');
           $imageName = $file->getClientOriginalName();
           $file->move(public_path('uploads/doctors'), $imageName);
           $data['image'] = $imageName;


           if($img)
           {
               $image_path = public_path('uploads/doctors/'.$img->image);

               if(file_exists($image_path))
               {
                   File::delete($image_path);
               }

           }

       }

         if(request()->has('password') && request()->get('password') != '')
         {
             $data['password'] = bcrypt($data['password']);
            Doctor::findOrfail($id)->update($data);
         }else{
             unset($data['password']);
             Doctor::findOrfail($id)->update($data);
         }
         alert()->success(trans('admin.update'), 'Done');
         return back();
     }


}

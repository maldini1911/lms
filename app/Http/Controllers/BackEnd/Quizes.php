<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questions;
use App\Models\Quize;
use App\Models\Lecture;
use App\Models\Doctor;
use App\Models\Student;
use App\Models\Answer;
use App\Models\CourseDoctor;
use Notification;
use Auth;
use Carbon\Carbon;

class Quizes extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $quizes =  Quize::where('doctor_id', Auth()->guard('doctor')->user()->id)->paginate();
    return view('Admin.quizes.index', compact('quizes'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $courses = CourseDoctor::where('doctor_id', auth()->guard('doctor')->user()->id)->get();
    $lectures = Lecture::where('doctor_id', auth()->guard('doctor')->user()->id)->get();
    return view('Admin.quizes.create', compact('courses', 'lectures'));

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {

    //========================================================
    $course_id = $request->input('course_id');
    $lecture_id = $request->input('lecture_id');
    $doctor_id = Auth::guard('doctor')->user()->id;
    $code_quize = $request->input('code_quize');
    $totalMark = $request->input('fullmark');
    $totalTime = $request->input('full_time');
    //=========================================================



    $code = Quize::where('code_quize', $code_quize)->where('course_id', $course_id)
    ->where('doctor_id', $doctor_id)->first();

    //=== If Found Quize
    if($code)
    {

        //=== Start Create Assignment =====
        switch ($request->input('action')) {
            case 'publish':
                $data['quize_status'] = 'publish';
                break;

            case 'save':
                $data['quize_status'] = 'save';
                break;

            case 'scheduling':
                $data['quize_status'] = 'scheduling';
                $data['course_status'] = 'scheduling';
                $data['start_scheduling'] = $request->start_scheduling;
    			      $data['finish_scheduling'] = $request->finish_scheduling;
                break;
            case 'advanced_edit':
                // Redirect to advanced edit
                break;
            }



        //=========> Add Question Edit Image
        if(request()->has('question_edit_image'))
        {
            $question_edit_image = $request->question_edit_image;
            $mark_edit_image = $request->mark_edit_image;
            $time_edit_image  = $request->time_edit_image;

            for($count = 0; $count < count($question_edit_image); $count++)
            {
              $data_edit_image = array(
                  'question'                  => $question_edit_image[$count],
                  'answer'                    => "pending",
                  'quize_id'                  => $code->id,
                  'doctor_id'                 => $doctor_id,
                  'course_id'                 => $course_id,
                  'mark'                      => $mark_edit_image,
                  'time'                      => $time_edit_image,
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
            $time_text = $request->input('time_text');

            for($count = 0; $count < count($question_text); $count++)
            {
                $data_text = array(
                        'question'                  => $question_text[$count],
                        'answer'                    => $answer_text[$count],
                        'quize_id'                  => $code->id,
                        'doctor_id'                 => $doctor_id,
                        'course_id'                 => $course_id,
                        'mark'                      => $mark_text,
                        'time'                      => $time_text,
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
        $time_choise = $request->input('time_choise');

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
                    'quize_id'                  => $code->id,
                    'doctor_id'                 => $doctor_id,
                    'course_id'                 => $course_id,
                    'mark'                      => $mark_choise,
                    'time'                      => $time_choise,
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
                    'quize_id'                  => $code->id,
                    'doctor_id'                 => $doctor_id,
                    'course_id'                 => $course_id,
                    'mark'                      => $mark_choise,
                    'time'                      => $time_choise,
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
                    'quize_id'                  => $code->id,
                    'doctor_id'                 => $doctor_id,
                    'course_id'                 => $course_id,
                    'mark'                      => $mark_choise,
                    'time'                      => $time_choise,
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
            $time_correct = $request->input('time_correct');


            for($count = 0; $count < count($question_correct); $count++)
            {
                $data_correct = array(
                        'question'                  => $question_correct[$count],
                        'true'                      => $true_correct[$count],
                        'quize_id'                  => $code->id,
                        'doctor_id'                 => $doctor_id,
                        'course_id'                 => $course_id,
                        'mark'                      => $mark_correct,
                        'time'                      => $time_correct,
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
            $time_file_correct = $request->input('time_file_correct');


            $question_file = array();
            if($files = $request->file('question_file')){
                foreach($files as $file)
                {
                    $fileName = time().$file->getClientOriginalName();

                    $file->move(public_path('uploads/questions/quizes'), $fileName);
                }
            //====> End More Upload Photos
            }

            for($count = 0; $count < count($title_file); $count++)
            {
                $data_file = array(
                        'title'                     => $title_file[$count],
                        'question'                  => $fileName,
                        'answer'                    => $answer_file[$count],
                        'quize_id'                  => $code->id,
                        'doctor_id'                 => $doctor_id,
                        'course_id'                 => $course_id,
                        'mark'                      => $mark_file_correct,
                        'time'                      => $time_file_correct,
                        'type'                      => 'image_true_false',
                        'created_at'                => Carbon::now()
                    );

                $insert_file_question[] = $data_file;
            }

            Questions::insert($insert_file_question);

        }


    }else{


    //=== If not Quize
    //=== Start Create Quize =====
    switch ($request->input('action')) {
        case 'publish':
            $data['quize_status'] = 'publish';
            break;

        case 'save':
            $data['quize_status'] = 'save';
            break;

        case 'scheduling':
            $data['quize_status'] = 'scheduling';
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
            $id = Quize::insertGetId([
                'course_id'             => $course_id,
                'doctor_id'             => $doctor_id,
                'code_quize'            => $code_quize,
                'course_scheduling'     => $request->input('course_scheduling'),
                'quize_status'          => $request->input('action'),
                'lecture_id'            => $lecture_id,
                'fullmark'              => $totalMark,
                'full_time'             => $totalTime
            ]);

        }else{
            $id = Quize::insertGetId([
                'course_id'             => $course_id,
                'doctor_id'             => $doctor_id,
                'code_quize'            => $code_quize,
                'quize_status'          => $request->input('action'),
                'lecture_id'            => $lecture_id,
                'fullmark'              => $totalMark,
                'full_time'             => $totalTime
            ]);
        }
    //=== End Create Quize =======


    //=========> Add Question Edit Image
    if(request()->has('question_edit_image'))
    {
        $question_edit_image = $request->question_edit_image;
        $mark_edit_image = $request->mark_edit_image;
        $time_edit_image  = $request->input('time_edit_image');


        for($count = 0; $count < count($question_edit_image); $count++)
        {
          $data_edit_image = array(
              'question'                  => $question_edit_image[$count],
              'answer'                    => "pending",
              'quize_id'                  => $id,
              'doctor_id'                 => $doctor_id,
              'course_id'                 => $course_id,
              'mark'                      => $mark_edit_image,
              'time'                      => $time_edit_image,
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
        $time_text = $request->input('time_text');

        for($count = 0; $count < count($question_text); $count++)
        {
            $data_text = array(
                    'question'                  => $question_text[$count],
                    'answer'                    => $answer_text[$count],
                    'quize_id'                  => $id,
                    'doctor_id'                 => $doctor_id,
                    'course_id'                 => $course_id,
                    'mark'                      => $mark_text,
                    'time'                      => $time_text,
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
    $time_choise = $request->input('time_choise');

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
                'quize_id'                  => $id,
                'doctor_id'                 => $doctor_id,
                'course_id'                 => $course_id,
                'mark'                      => $mark_choise,
                'time'                      => $time_choise,
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
                'quize_id'                  => $id,
                'doctor_id'                 => $doctor_id,
                'course_id'                 => $course_id,
                'mark'                      => $mark_choise,
                'time'                      => $time_choise,
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
                'quize_id'                  => $id,
                'doctor_id'                 => $doctor_id,
                'course_id'                 => $course_id,
                'mark'                      => $mark_choise,
                'time'                      => $time_choise,
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
        $time_correct = $request->input('time_correct');


        for($count = 0; $count < count($question_correct); $count++)
        {
            $data_correct = array(
                    'question'                  => $question_correct[$count],
                    'true'                      => $true_correct[$count],
                    'quize_id'                  => $id,
                    'doctor_id'                 => $doctor_id,
                    'course_id'                 => $course_id,
                    'mark'                      => $mark_correct,
                    'time'                      => $time_correct,
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
        $time_file_correct = $request->input('time_file_correct');


        $question_file = array();
        if($files = $request->file('question_file')){
            foreach($files as $file)
            {
                $fileName = time().$file->getClientOriginalName();

                $file->move(public_path('uploads/questions/quizes'), $fileName);
            }
        //====> End More Upload Photos
        }

        for($count = 0; $count < count($title_file); $count++)
        {
            $data_file = array(
                    'title'                     => $title_file[$count],
                    'question'                  => $fileName,
                    'answer'                    => $answer_file[$count],
                    'quize_id'                  => $id,
                    'doctor_id'                 => $doctor_id,
                    'course_id'                 => $course_id,
                    'mark'                      => $mark_file_correct,
                    'time'                      => $time_file_correct,
                    'type'                      => 'image_true_false',
                    'created_at'                => Carbon::now()
                );

            $insert_file_question[] = $data_file;
        }

        Questions::insert($insert_file_question);

    }


    //===> Send Notification
    $user = Student::where('term_id', auth()->guard('doctor')->user()->term_id)->get();
    $title = $code_quize;
    $doctor = auth()->guard('doctor')->user()->name;
    $id_type = $id;
    $type = "quizes";

    Notification::send($user, new \App\Notifications\LecturesStudent($title, $doctor, $type, $id_type));
    }



    alert()->success(trans('admin.success'), 'Done');
    return back();
  }

public function show($id)
{

    $questions = Questions::where('quize_id', $id)->get();
    return view('Admin.quizes.view', compact('questions'));
}


  public function edit($id)
  {

        $questions = Questions::where('quize_id', $id)->get();
        $courses = CourseDoctor::where('doctor_id', auth()->guard('doctor')->user()->id)->get();
        $lectures  = Lecture::where('doctor_id', auth()->guard('doctor')->user()->id)->get();
        $row = Quize::find($id)->first();
        return view('Admin.quizes.edit', compact("questions", 'courses', 'lectures', 'row'));
  }


  public function quize_update(Request $request, $id)
  {

    //========================================================
    $course_id = $request->input('course_id');
    $lecture_id = $request->input('lecture_id');
    $doctor_id = Auth::guard('doctor')->user()->id;
    $code_quize = $request->input('code_quize');
    $totalMark = $request->input('fullmark');
    $totalTime = $request->input('full_time');
    //=========================================================


    //=== Start Create Assignment =====
    switch ($request->input('action')) {
        case 'publish':
            $data['quize_status'] = 'publish';
            break;

        case 'save':
            $data['quize_status'] = 'save';
            break;

        case 'scheduling':
            $data['quize_status'] = 'scheduling';
            break;
        case 'advanced_edit':
            // Redirect to advanced edit
            break;
        }


        if(request()->has('course_scheduling'))
        {
            Quize::find($id)->update([
                'course_id'             => $course_id,
                'doctor_id'             => $doctor_id,
                'code_quize'            => $code_quize,
                'course_scheduling'     => $request->input('course_scheduling'),
                'course_status'         => $request->input('action'),
                'lecture_id'            => $lecture_id,
                'fullmark'              => $totalMark,
                'full_time'             => $totalTime
            ]);

        }else{
            Quize::find($id)->update([
                'course_id'             => $course_id,
                'doctor_id'             => $doctor_id,
                'code_quize'            => $code_quize,
                'course_status'         => $request->input('action'),
                'lecture_id'            => $lecture_id,
                'fullmark'              => $totalMark,
                'full_time'             => $totalTime
            ]);
        }

        alert()->success(trans('admin.update'), 'Done');
        return back();


  }

  public function quize_question_update(Request $request, $id)
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

            $question->move(public_path('uploads/questions/quizes'), $fileName);

            $data['question'] = $fileName;

            $image_path = public_path('uploads/questions/quizes/'.$img->question);

            if(file_exists($image_path))
            {
                File::delete($image_path);
            }

        }

        if($request->hasFile('choise1')){

            $fileName1 = time().$choise1->getClientOriginalName();

            $choise1->move(public_path('uploads/questions/quizes'), $fileName1);

            $data['choise1'] = $fileName1;

            $image_path = public_path('uploads/questions/quizes/'.$img->choise1);

            if(file_exists($image_path))
            {
                File::delete($image_path);
            }

        }

        if($request->hasFile('choise2')){

                $fileName2 = time().$choise2->getClientOriginalName();

                $choise2->move(public_path('uploads/questions/quizes'), $fileName2);

                $data['choise2'] = $fileName2;

                $image_path = public_path('uploads/questions/quizes/'.$img->choise2);

                if(file_exists($image_path))
                {
                    File::delete($image_path);
                }
        }

        if($request->hasFile('choise3')){

                $fileName3 = time().$choise3->getClientOriginalName();

                $choise3->move(public_path('uploads/questions/quizes'), $fileName3);

                $data['choise3'] = $fileName3;

                $image_path = public_path('uploads/questions/quizes/'.$img->choise3);

                if(file_exists($image_path))
                {
                    File::delete($image_path);
                }
        }

        if($request->hasFile('choise4')){

                $fileName4 = time().$choise4->getClientOriginalName();

                $choise4->move(public_path('uploads/questions/quizes'), $fileName4);

                $data['choise4'] = $fileName4;

                $image_path = public_path('uploads/questions/quizes'.$img->choise4);

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

            $file->move(public_path('uploads/questions/quizes'), $fileName);

            $img = Questions::find($id);

            //dd($img->question);
            if($img)
            {
                $image_path = public_path('uploads/questions/quizes/'.$img->question);

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


  public function destroy($id)
  {
      Quize::find($id)->delete();
      alert()->success("Successufly Delete", 'Done');
      return back();
  }


  public function quizes_question_text($id)
  {
      $delete = TextQuestion::find($id);
      $delete->delete();
      return back();
  }

  public function quizes_question_choise($id)
  {
      $delete = QuestionChoice::find($id);
      $delete->delete();
      return back();
  }

  public function quizes_question_correct($id)
  {
      $delete = TrueFalse::find($id);
      $delete->delete();
      return back();
  }

  public function quizes_question_file($id)
  {
      $delete = ImageTrueFase::find($id);
      $delete->delete();
      return back();
  }


  public function multi_delete()
    {

        if(is_array(request('item'))){

            Quize::destroy(request('item'));

        }else{

            Quize::find(request('item'))->delete();

        }

        return back();
    }

    public function show_answers($id)
    {
        $rows = Answer::where('quize_id', $id)->get();
        return view('Admin.quizes.answers', compact('rows'));
    }


    public function view_answers($id)
    {
        $row = Answer::where('id', $id)->first();
        return view('Admin.quizes.view_answers', compact('row'));
    }

    public function student_answers($id, $qz)
    {
        $rows = Answer::where('student_id', $id)->where('quize_id', $qz)->get();
        return view('Admin.quizes.answer_student', compact('rows'));
    }

}

?>

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Student;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Lesson;
use Notification;
use Auth;
use DB;
use Carbon\Carbon;

class scheduling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scheduling';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lecture Scheduling';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

      $lectures = Lecture::where('lecture_status', 'scheduling')->get();
      $lessons = Lesson::where('lesson_status', 'scheduling')->get();

      foreach($lectures as $lecture)
      {
        $now = date('Y-m-d H:i');
        $doctor = $lecture->doctor['name'];

        if($lecture->start_scheduling == $now)
        {
          //============|| Setting Notifications ||
          $term_course = Course::where('id', $lecture->course_id)->first();
          $term_id =  $term_course->term_id;
          $user = Student::whereHas('student_terms', function($query) use($term_id){
              $query->where('term_id', $term_id);
          })->get();

          $title = $lecture->title;
          $doctor = $lecture->doctor['name'];
          $id_type = $lecture->id;
          $type = "lecture";
          Notification::send($user, new \App\Notifications\LecturesStudent($title, $doctor, $type, $id_type));
          Lecture::where('id', $lecture->id)->update(['lecture_status' => 'publish']);
        }

      }


      foreach($lessons as $lesson)
      {
        $now = date('Y-m-d H:i');
        $doctor = $lesson->doctor['name'];

        if($lesson->start_scheduling == $now)
        {
          //============|| Setting Notifications ||
          $term_course = Course::where('id', $lesson->course_id)->first();
          $term_id =  $term_course->term_id;
          $user = Student::whereHas('student_terms', function($query) use($term_id){
              $query->where('term_id', $term_id);
          })->get();

          $title = $lesson->title;
          $doctor = $lesson->doctor['name'];
          $id_type = $lesson->id;
          $type = "lesson";
          Notification::send($user, new \App\Notifications\LecturesStudent($title, $doctor, $type, $id_type));
          Lesson::where('id', $lesson->id)->update(['lesson_status' => 'publish']);
        }

      }

    }
}

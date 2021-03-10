<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{

    protected $table = 'lectures';
    public $timestamps = true;
    protected $fillable = array('title', 'desc', 'content', 'doctor_id', 'course_id', 'lecture_status', 'lecture_scheduling',
     'lecture_image', 'lecture_video', 'show_media', 'lecture_hour', 'theory_hour', 'applied_hour', 'start_scheduling', 'finish_scheduling');

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function urls()
    {
        return $this->hasMany('App\Models\UrlLectureLesson');
    }

    public function videos()
    {
        return $this->hasMany('App\Models\VideoLectureLesson');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ImageLectureLesson');
    }

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }

    public function attachments()
    {
        return $this->hasMany('App\Models\Attachment');
    }

     public function assignments()
    {
        return $this->hasMany('App\Models\Assignment');
    }

      public function quizes()
    {
        return $this->hasMany('App\Models\Quize');
    }

    public function studentattends()
    {
        return $this->hasMany('App\Models\StudentAttend');
    }

    public function interactive_sessions_lecture()
    {
        return $this->hasMany('App\Models\InteractiveSessionLecture');
    }

    public function interactive_session_attend()
    {
      return $this->hasMany('App\Models\InteractiveSessionAttend');
    }



}

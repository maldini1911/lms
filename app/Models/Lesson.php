<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    protected $table = 'lessons';
    public $timestamps = true;
    protected $fillable = array('title', 'desc', 'content', 'doctor_id', 'course_id', 'lecture_id',
     'lesson_status', 'lesson_scheduling', 'lesson_video', 'lesson_image', 'show_media',
      'start_scheduling', 'finish_scheduling', 'lesson_hour', 'theory_hour', 'applied_hour');

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

    public function lecture()
    {
        return $this->belongsTo('App\Models\Lecture');
    }

    public function attachments()
    {
        return $this->hasMany('App\Models\Attachment');
    }

    public function studentattends()
    {
        return $this->hasMany('App\Models\StudentAttend');
    }

    public function interactive_sessions_lessons()
    {
        return $this->hasMany('App\Models\InteractiveSessionLesson');
    }



}

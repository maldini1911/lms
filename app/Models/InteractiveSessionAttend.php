<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InteractiveSessionAttend extends Model
{
    protected $table = 'interactive_session_attends';
    protected $fillable = ['lecture_id', 'lesson_id', 'student_id'];

    public function lecture()
    {
      return $this->belongsTo('App\Models\Lecture');
    }

    public function lesson()
    {
      return $this->belongsTo('App\Models\Lesson');
    }

    public function student()
    {
      return $this->belongsTo('App\Models\Student');
    }
}

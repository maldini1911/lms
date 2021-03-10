<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonSession extends Model
{

    protected $table = 'lessons_sessions';
    public $timestamps = true;
    protected $fillable = array('file', 'url_file', 'lecture_id', 'lesson_id');

    public function lecture()
    {
        return $this->belongsTo('App\Models\Lecture');
    }

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }

}

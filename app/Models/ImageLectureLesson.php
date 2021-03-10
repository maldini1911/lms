<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageLectureLesson extends Model
{

    protected $table = 'image_lectures_lessons';
    public $timestamps = true;
    protected $fillable = array('image', 'lecture_id', 'lesson_id');

    public function lecture()
    {
        return $this->belongsTo('App\Models\Lecture');
    }

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }

}

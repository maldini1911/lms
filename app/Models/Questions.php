<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{

    protected $table = 'questions';
    public $timestamps = true;
    protected $fillable = array('type', 'question', 'answer', 'course_id', 'assignment_id', 'quize_id', 'lecture_id', 'doctor_id', 'time', 'mark', 'title', 'choise1', 'choise2', 'choise3', 'choise4');

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment');
    }

    public function quize()
    {
        return $this->belongsTo('App\Models\Quize');
    }

    public function lecture()
    {
        return $this->belongsTo('App\Models\Lecture');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

}

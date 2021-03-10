<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quize extends Model
{
    protected $table = 'quizes';
    public $timestamps = true;
    protected $fillable = array('course_id', 'doctor_id', 'code_quize', 'quize_status',  'course_scheduling', 'fullmark', 'lecture_id', 'full_time');

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function lecture()
    {
        return $this->belongsTo('App\Models\Lecture');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }
}

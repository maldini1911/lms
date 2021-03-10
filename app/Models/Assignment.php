<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignments';
    public $timestamps = true;
    protected $fillable = array('name_assignment', 'course_id', 'doctor_id', 'code_assignment', 'course_status', 'course_scheduling', 'full_time', 'fullmark', 'lecture_id');


    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseDoctor extends Model
{
    protected $table = 'course_doctors';
    public $timestamps = true;
    protected $fillable = array('doctor_id', 'course_id', 'academic_year');

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor');
    }

    public function courses()
    {
        return $this->hasMany('App\Models\Course', 'id', 'course_id');
    }

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

}

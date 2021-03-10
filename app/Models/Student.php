<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{

    use Notifiable;

    protected $table = 'students';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'mobile', 'faculty_id', 'image');

    public function faculty()
    {
        return $this->belongsTo('App\Models\Faculty');
    }

    public function term()
    {
        return $this->belongsTo('App\Models\Term');
    }

    public function MembersSubjects()
    {
        return $this->hasMany('App\Models\MemberSubject');
    }

    public function lectures()
    {
        return $this->hasMany('App\Models\Lecture');
    }

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }

    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

    public function assignments()
    {
        return $this->hasMany('App\Models\Assignment');
    }

    public function quizes()
    {
        return $this->hasMany('App\Models\Quize');
    }

    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }
    public function studentattends()
    {
        return $this->hasMany('App\Models\StudentAttend');
    }

    public function student_terms()
    {
        return $this->hasMany('App\Models\StudentTerm');
    }

    public function student_term()
    {
        return $this->belongsTo('App\Models\StudentTerm', 'student_id');
    }


}

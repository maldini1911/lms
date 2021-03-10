<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{

    use Notifiable;

    protected $table = 'doctors';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'mobile', 'term_id', 'interactive_sessions',
     'image', 'role', 'work_start');


    public function term()
    {
        return $this->belongsTo('App\Models\Term');
    }

    public function lectures()
    {
        return $this->hasMany('App\Models\Lecture');
    }

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Questions');
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


    public function courses_doctors()
    {
        return $this->hasMany('App\Models\CourseDoctor');
    }

    public function doctorterms()
    {
        return $this->hasMany('App\Models\DoctorTerm');
    }

    public function studentattends()
    {
        return $this->hasMany('App\Models\StudentAttend');
    }


}

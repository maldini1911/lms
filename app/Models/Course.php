<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $table = 'courses';
    public $timestamps = true;
    protected $fillable = array('name', 'type', 'specialty_id', 'course_hour', 'squad_id', 'term_id',
    'course_goals', 'theory_hour', 'applied_hour', 'information_concepts', 'skills_professional',
    'skills_mindset', 'skills_public'
  );

    public function specialty()
    {
        return $this->belongsTo('App\Models\Specialty');
    }

    public function squad()
    {
        return $this->belongsTo('App\Models\Term', 'squad_id');
    }

    public function term()
    {
        return $this->belongsTo('App\Models\Term', 'term_id');
    }

    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function lectures()
    {
        return $this->hasMany('App\Models\Lecture');
    }

    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }

    public function assignments()
    {
        return $this->hasMany('App\Models\Assignment');
    }

    public function coursesdoctors()
    {
        return $this->hasMany('App\Models\CourseDoctor');
    }

}

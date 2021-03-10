<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{

    protected $table = 'terms';
    public $timestamps = true;
    protected $fillable = array('academic_year', 'term', 'faculty_id');

    public function faculty()
    {
        return $this->belongsTo('App\Models\Faculty');
    }

    public function specialties()
    {
      return $this->hasMany('App\Models\Specialty');
    }

    public function student_term()
    {
        return $this->hasMany('App\Models\StudentTerm');
    }

    public function depardment_term()
    {
        return $this->hasMany('App\Models\DepardmentTerm');
    }

}

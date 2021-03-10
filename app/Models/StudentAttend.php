<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttend extends Model
{

     protected $fillable = [
         'lecture_id', 'student_id','doctor_id', 'student_out', 'year'
    ];

     public function student()
     {
      return $this->belongsTo('App\Models\Student');
     }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function lecture()
    {
        return $this->belongsTo('App\Models\Lecture');
    }

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }


}

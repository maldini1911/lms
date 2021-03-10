<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';
    public $timestamps = true;
    protected $fillable = array('assignment_id', 'quize_id', 'student_id', 'student_mark', 'result');

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function answer()
    {
        return $this->belongsTo('App\Models\Answer');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment');
    }

    public function quize()
    {
        return $this->belongsTo('App\Models\Quize');
    }

}

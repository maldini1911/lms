<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    protected $table = 'answers';
    public $timestamps = true;
    protected $fillable = array('answer', 'question_id', 'assignment_id', 'quize_id', 'student_id', 'mark', 'anwser_image');

    public function question()
    {
        return $this->belongsTo('App\Models\Questions');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Questions');
    }

    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment');
    }

    public function quize()
    {
        return $this->belongsTo('App\Models\Quize');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function results()
    {
        return $this->hasMany('App\Models\Result');
    }

}

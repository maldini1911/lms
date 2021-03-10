<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentTerm extends Model
{


    protected $table = 'student_terms';
    protected $fillable = array('student_id', 'term_id', 'year', 'status_term');

    public function term()
    {
        return $this->belongsTo('App\Models\Term');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

}

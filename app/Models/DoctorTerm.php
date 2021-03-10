<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class DoctorTerm extends Model
{


    protected $table = 'doctor_terms';
    public $timestamps = true;
    protected $fillable = array('doctor_id', 'term_id', 'year');

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor');
    }

    public function term()
    {
        return $this->belongsTo('App\Models\Term');
    }

    public function terms()
    {
        return $this->hasMany('App\Models\Term');
    }


}

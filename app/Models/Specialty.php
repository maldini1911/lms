<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{

    protected $table = 'specialties';
    public $timestamps = true;
    protected $fillable = array('name', 'faculty_id', 'years');

    public function faculty()
    {
        return $this->belongsTo('App\Models\Faculty');
    }

    public function term()
    {
        return $this->belongsTo('App\Models\Term');
    }

    public function courses()
    {
        return $this->hasMany('App\Models\Course');
    }

    public function depardment_term()
    {
        return $this->hasMany('App\Models\DepardmentTerm');
    }





}

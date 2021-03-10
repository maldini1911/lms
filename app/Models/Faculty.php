<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{

    protected $table = 'faculties';
    public $timestamps = true;
    protected $fillable = array('name', 'university_id');

    public function students()
    {
        return $this->hasMany('App\Models\Student');
    }

    public function university()
    {
        return $this->belongsTo('App\Models\University');
    }

    public function terms()
    {
        return $this->hasMany('App\Models\Term');
    }

    public function specialties()
    {
      return $this->hasMany('App\Models\Specialty');
    }

}

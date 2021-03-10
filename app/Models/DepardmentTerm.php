<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepardmentTerm extends Model
{
    protected $table = 'depardment_terms';
    protected $fillable = ['specialty_id', 'term_id'];

    public function term()
    {
      return $this->belongsTo('App\Models\Term');
    }

    public function specialty()
    {
      return $this->belongsTo('App\Models\Specialty');
    }

    public function courses()
    {
        return $this->hasMany('App\Models\Course');
    }
}

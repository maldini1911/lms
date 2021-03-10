<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InteractiveSessionLecture extends Model
{
    protected $table = 'interactive_sessions_lectures';
    protected $fillable = ['lecture_id', 'url_session'];

    public function lecture()
    {
      return $this->belongsTo('App\Models\Lecture');
    }
}

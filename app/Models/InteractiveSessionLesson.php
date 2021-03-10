<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InteractiveSessionLesson extends Model
{
  protected $table = 'interactive_session_lessons';
  protected $fillable = ['lesson_id', 'url_session'];

  public function lesson()
  {
    return $this->belongsTo('App\Models\Lesson');
  }
}

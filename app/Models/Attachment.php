<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = 'attachments';
    public $timestamps = true;
    protected $fillable = array('file_name', 'file_type', 'lecture_id', 'lesson_id');

    public function lecture()
    {
        return $this->belongsTo('App\Models\Lecture');
    }

    public function lesson()
    {
        return $this->belongsTo('App\Models\Lesson');
    }
}

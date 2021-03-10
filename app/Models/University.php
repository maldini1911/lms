<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model 
{

    protected $table = 'universities';
    public $timestamps = true;
    protected $fillable = array('name');

    public function faculties()
    {
        return $this->hasMany('App\Models\Faculty');
    }

}
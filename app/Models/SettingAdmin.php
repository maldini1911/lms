<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingAdmin extends Model
{

    protected $table = 'setting_admins';
    public $timestamps = true;
    protected $fillable = array('title', 'icon', 'logo', 'background_login', 'copyright');

}

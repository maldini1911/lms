<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseDoctor;

class FilterSquads extends Controller
{

  public function filter_squads($id)
  {
      return show_squads($id);
  }

}

?>

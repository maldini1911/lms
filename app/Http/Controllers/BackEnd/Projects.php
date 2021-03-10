<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



class Projects extends Controller
{

  public function index()
  {
    return view('Design.doctors.projects.index');
  }

  public function create()
  {
    return view('Design.doctors.projects.create');
  }

  public function edit()
  {
    return view('Design.doctors.projects.edit');
  }

  public function detailes()
  {
    return view('Design.doctors.projects.detailes');
  }
}

?>

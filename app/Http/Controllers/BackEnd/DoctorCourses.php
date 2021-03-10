<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseDoctor;

class DoctorCourses extends Controller
{

    public function course()
    {
        $rows = CourseDoctor::where('doctor_id', auth()->guard('doctor')->user()->id)->get();
        return view('Admin.doctor_course.index', compact('rows'));
    }

}

?>

<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Models\Result;
use App\Models\Lecture;
use App\Models\StudentAttend;
use Carbon\Carbon;
use Auth;


class ReportsStudentController extends Controller
{

    public function report_results_assignment()
    {

        $rows = Result::where('assignment_id', '!=', null)->where('student_id', auth()->guard('student')->user()->id)->paginate(10);
        return view('Design.student.reports.report_results_assignment', compact('rows'));
    }

    public function report_results_quize()
    {

        $rows = Result::where('quize_id', '!=', null)->where('student_id', auth()->guard('student')->user()->id)->paginate(10);
        return view('Design.student.reports.report_result_quize', compact('rows'));
    }

    public function logout_lecture($id)
    {
      $check_lecture = StudentAttend::where('lecture_id', $id)->where('student_id', auth()->guard('student')->user()->id)->first();
      if($check_lecture)
      {
        StudentAttend::where('lecture_id', $id)->update([
              'student_out' => Carbon::now()
        ]);
      }
    }

}

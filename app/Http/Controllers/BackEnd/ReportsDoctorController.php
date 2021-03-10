<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Models\Result;
use App\Models\StudentAttend;
use Auth;


class ReportsDoctorController extends Controller
{

    public function report_results_assignment()
    {

        $rows = Result::where('assignment_id', '!=', null)->paginate(10);
        return view('Admin.reports_doctors.report_results_assignment', compact('rows'));
    }

    public function report_results_quize()
    {

        $rows = Result::where('quize_id', '!=', null)->paginate(10);
        return view('Admin.reports_doctors.report_result_quize', compact('rows'));
    }

    public function report_attends_student()
    {
        $rows = StudentAttend::where('doctor_id', auth()->guard('doctor')->user()->id)->paginate(10);
        return view('Admin.reports_doctors.report_attends_student', compact('rows'));
    }


}

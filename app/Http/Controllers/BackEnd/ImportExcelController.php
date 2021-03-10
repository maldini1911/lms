<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Imports\DoctorImport;
use App\Imports\StudentImport;
use App\Imports\QuestionImport;
use App\Imports\QuizeImport;
use Maatwebsite\Excel\Facades\Excel;
use SweetAlert;

class ImportExcelController extends Controller
{

    public function importDoctor(Request $request)
    {
        $this->validate(request(), [
            'doctors' => 'required|mimes:xlsx'
        ]);

        Excel::import(new DoctorImport, $request->file('doctors'));
        alert()->success(trans('admin.success'), 'Done');
        return back();
    }

    public function importStudent(Request $request)
    {

        $this->validate(request(), [
            'students' => 'required|mimes:xlsx'
        ]);

        Excel::import(new StudentImport, $request->file('students'));
        alert()->success(trans('admin.success'), 'Done');
        return back();
    }

    public function importQuestions(Request $request)
    {
        $this->validate(request(), [
            'questions' => 'required|mimes:xlsx'
        ]);

        Excel::import(new QuestionImport, $request->file('questions'));
        alert()->success(trans('admin.success'), 'Done');
        return back();
    }

}

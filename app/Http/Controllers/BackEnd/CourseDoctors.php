<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Doctor;
use App\Models\CourseDoctor;
use App\Models\DoctorTerm;
use SweetAlert;

class CourseDoctors extends Controller
{

    public function index()
    {

        $rows = CourseDoctor::groupby('doctor_id')->paginate(10);
        return view('Admin.coursedoctors.index', compact('rows'));
    }


    protected function relations_create_edit()
    {
        return ['subjects' => Course::get()];
    }


    public function create($id)
    {
        $doctor = Doctor::where('id', $id)->first();
        $courses = Course::get();
        $terms = DoctorTerm::where('doctor_id', $id)->get();
        return view('Admin.coursedoctors.create', compact('doctor', 'courses', 'terms'));
    }


  public function store(Request $request)
  {
        $this->validate(request(), [
            'course_id'        => 'required',
            'doctor_id'        => 'required',
            'academic_year'    => 'required',
        ]);

        $courses = $request->course_id;
        for($count = 0; $count < count($courses); $count++)
        {

            $data = array(
                  'course_id'       => $courses[$count],
                  'doctor_id'       => $request->doctor_id,
                  'academic_year'   => $request->academic_year,
              );

              $insert_courses[] = $data;

        }

        CourseDoctor::insert($insert_courses);
        alert()->success(trans('admin.success'), 'Done');
        return redirect('admin/coursedoctors');
  }


    public function edit($id)
    {

        $row = CourseDoctor::where('id', $id)->first();
        $doctor = Doctor::where('id', $row->doctor_id)->first();
        $courses = Course::get();
        $terms = DoctorTerm::where('doctor_id', $row->doctor_id)->get();
        return view('Admin.coursedoctors.edit', compact('doctor', 'courses', 'row', 'terms'));
    }


    public function update(Request $request, $id)
    {
          $courses = $request->course_id;
          for($count = 0; $count < count($courses); $count++)
          {

              $data = array(
                    'course_id'       => $courses[$count],
                    'doctor_id'       => $request->doctor_id,
                    'academic_year'   => $request->academic_year,
                );

                $insert_courses[] = $data;

          }

          CourseDoctor::findOrfail($id)->update($insert_courses);
          alert()->success(trans('admin.update'), 'Done');
          return redirect('admin/coursedoctors');
      }


    public function show($id)
    {
        $rows = CourseDoctor::where('doctor_id', $id)->get();
        return view('Admin.coursedoctors.show', compact('rows'));
    }


    public function delete($id)
    {
        $row = CourseDoctor::find($id);
        $row->delete();
        alert()->success('Success Delete', 'Done');
        return back();
    }

}

?>

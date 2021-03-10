<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Term;
use App\Models\StudentTerm;
use File;

class Students extends BackEndController
{

  public function __construct(Student $model)
    {
        parent::__construct($model);
        //$this->middleware(['role:manger']);
    }

    protected function relations_create_edit()
    {
        return filter_squad();
    }

  public function store(Request $request)
  {
        $data = $this->validate(request(), [
            'name'                  => 'required|string',
            'email'                 => 'required|string|email|unique:students',
            'password'              => 'required|string',
            'mobile'                => 'sometimes|nullable',
            'faculty_id'            => 'required',
            'image'                 =>  validate_image(),
        ]);


        if(request()->hasFile('image'))
        {
            $file = $request->file('image');
            $imageName = time().$file->getClientOriginalName();
            $file->move(public_path('uploads/students'), $imageName);
            $data['image'] = $imageName;
        }

        $data['password'] = bcrypt($data['password']);

        $user_id = $this->model->insertGetId($data);


        if($request->has('term_id'))
        {

            $term = $request->term_id;

            StudentTerm::create([
                'student_id'      => $user_id,
                'term_id'         => $term,
                'year'            => date('Y'),
                'status_term'     => 1,
            ]);
        }

        alert()->success(trans('admin.success'), 'Done');
        return redirect()->route('students.index');
  }

  public function update(Request $request, $id)
  {

      $data = $this->validate(request(), [
          'name'                  => 'required|string',
          'email'                 => 'sometimes|nullable|string|email|unique:students,email,'.$id,
          'password'              => 'sometimes|nullable',
          'mobile'                => 'sometimes|nullable',
          'faculty_id'            => 'required',
          'image'                 =>  validate_image(),
      ]);


      $img = Student::find($id)->first();
      if(request()->hasFile('image'))
      {
          $file = $request->file('image');
          $imageName = time().$file->getClientOriginalName();

          $file->move(public_path('uploads/students'), $imageName);

          $data['image'] = $imageName;

          if($img)
          {
              $image_path = public_path('uploads/students/'.$img->image);

              if(file_exists($image_path))
              {
                  File::delete($image_path);
              }

          }

      }

        if(request()->has('password') && request()->get('password') != '')
        {
            $data['password'] = bcrypt($data['password']);
            $this->model->findOrfail($id)->update($data);
        }else{
            unset($data['password']);
            $this->model->findOrfail($id)->update($data);
        }


        if($request->has('term_id'))
        {
          $term = $request->term_id;

            StudentTerm::where('id', $term)->update([
                'student_id'      => $id,
                'term_id'         => $term,
                'year'            => date('Y'),
                'status_term'     => 1
            ]);
        }

        alert()->success(trans('admin.update'), 'Done');
        return redirect()->route('students.edit', ['id' => $id]);
    }

    public function show($id)
    {
      $row = Student::find($id)->first();
      return view('Admin.students.show', compact('row'));
    }


    public function multi_delete()
    {

        if(is_array(request('item'))){

            $this->model->destroy(request('item'));

        }else{

            $this->model->find(request('item'))->delete();

        }

        return back();
    }


}

?>

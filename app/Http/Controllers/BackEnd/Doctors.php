<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\DoctorTerm;
use App\Models\Faculty;
use App\Models\Term;
use File;

class Doctors extends BackEndController
{

  public function __construct(Doctor $model)
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
            'name'                      => 'required|string',
            'email'                     => 'required|string|email|unique:doctors',
            'password'                  => 'required|string',
            'mobile'                    => 'sometimes|nullable',
            'image'                     =>  validate_image(),
            'role'                      => 'sometimes|nullable',
            'work_start'                => 'sometimes|nullable',
        ]);

        if(request()->hasFile('image'))
        {
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            $file->move(public_path('uploads/doctors'), $imageName);
            $data['image'] = $imageName;
        }

        $data['password'] = bcrypt($data['password']);

        $user = $this->model->insertGetId($data);



      //====|| Start Add Terms For Doctors ||
      if(request()->has('term'))
      {
          $terms = $request->term;
          for($count = 0; $count < count($terms); $count++)
          {
              $term = array(
                  'doctor_id'       => $user,
                  'term_id'         => $terms[$count],
                  'year'            => date('Y')
              );

              $term_insert[] = $term;
          }
          DoctorTerm::insert($term_insert);
      }

        alert()->success(trans('admin.success'), 'Done');
        return redirect()->route('doctors.index');
  }

  public function update(Request $request, $id)
  {
      $data = $this->validate(request(), [
          'name'                      => 'required|string',
          'email'                     => 'required|string|email|unique:doctors,email,'.$id,
          'password'                  => 'sometimes|nullable',
          'mobile'                    => 'sometimes|nullable',
          'interactive_sessions'      => 'sometimes|nullable',
          'image'                     =>  validate_image(),
          'role'                      => 'sometimes|nullable',
          'work_start'                => 'sometimes|nullable',
      ]);

        //===||Start Edit Image Profile ||
        if(request()->hasFile('image'))
      {
          $file = $request->file('image');
          $imageName = $file->getClientOriginalName();
          $file->move(public_path('uploads/doctors'), $imageName);
          $data['image'] = $imageName;
          $img = Doctor::find($id)->first();
          if($img)
          {
              $image_path = public_path('uploads/doctors/'.$img->image);

              if(file_exists($image_path))
              {
                  File::delete($image_path);
              }

          }

      }
        //===> End Edit Image Profile


        //=====|| Start Change Password ||
        if(request()->has('password') && request()->get('password') != '')
        {

            $data['password'] = bcrypt($data['password']);
            $this->model->findOrfail($id)->update($data);
        }else{

            unset($data['password']);
            $this->model->findOrfail($id)->update($data);
        }

        //====|| Start Add Terms For Doctors ||
      if(request()->has('term'))
      {
          $terms = $request->term;
          for($count = 0; $count < count($terms); $count++)
          {
              $term = array(
                  'doctor_id'       => $id,
                  'term_id'         => $terms[$count],
                  'year'            => date('Y')
              );

              $term_insert[] = $term;
          }
          DoctorTerm::insert($term_insert);
      }


        alert()->success(trans('admin.update'), 'Done');
        return redirect()->route('doctors.edit', ['id' => $id]);
    }


    public function show($id)
    {
        $row = $this->model->where('id', $id)->first();
        return view('Admin.doctors.show', compact('row'));
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

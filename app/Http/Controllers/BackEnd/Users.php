<?php

namespace App\Http\Controllers\BackEnd;
use Illuminate\Http\Request;
use App\User;
use File;

class Users extends BackEndController
{

    public function __construct(User $model)
    {
        parent::__construct($model);
        $this->middleware(['auth:web']);
    }

    public function store(Request $request)
    {
        $data = $this->validate(request(), [
            'name'          => 'required|string',
            'email'         => 'required|string|email|unique:users',
            'password'      => 'sometimes|nullable|string',
            'role'          => 'string',
            'image'         =>  validate_image(),
        ]);


        if(request()->hasFile('image'))
        {
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            $file->move(public_path('uploads/admin'), $imageName);
            $data['image'] = $imageName;
        }


        $data['password'] = bcrypt($data['password']);

        $user = $this->model->create($data);

        alert()->success(trans('admin.success'), 'Done');
        return redirect()->route('users.index');
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate(request(), [
            'name'          => 'required|string',
            'email'         => 'required|string|email|unique:users,email,'.$id,
            'password'      => 'sometimes|nullable|string',
            'role'          => 'string',
            'image'         =>  validate_image(),
        ]);


        $img = User::find($id)->first();
        if(request()->hasFile('image'))
        {
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            $file->move(public_path('uploads/admin'), $imageName);
            $data['image'] = $imageName;


            if($img)
            {
                $image_path = public_path('uploads/admin/'.$img->image);

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


        alert()->success(trans('admin.update'), 'Done');
        return redirect()->route('users.edit', ['id' => $id]);
    }


    public function show($id)
    {

      $row = $this->model->where('id', $id)->first();
      return view('Admin.users.show', compact('row'));
    }

}

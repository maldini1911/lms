<?php

namespace App\Http\Controllers\BackEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SettingAdmin;
use File;

class SettingAdmins extends Controller
{

    public function index()
    {
        $row = SettingAdmin::latest()->first();
        return view('Admin.setting_admin', compact('row'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validate(Request(), [
          'title'             => 'required|string',
          'copyright'         => 'required|string',
          'icon'              =>  validate_image(),
          'logo'              =>  validate_image(),
          'background_login'  =>  validate_image()
        ]);


        $img = SettingAdmin::find($id)->first();
        if(request()->hasFile('icon'))
        {
            $file = $request->file('icon');
            $imageName = $file->getClientOriginalName();
            $file->move(public_path('uploads/admin/setting'), $imageName);
            $data['icon'] = $imageName;

            $image_path = public_path('uploads/admin/setting/'.$img->icon);

            if(file_exists($image_path))
            {
                File::delete($image_path);
            }
        }


        if(request()->hasFile('logo'))
        {
            $file = $request->file('logo');
            $imageName = $file->getClientOriginalName();
            $file->move(public_path('uploads/admin/setting'), $imageName);
            $data['logo'] = $imageName;

            $image_path = public_path('uploads/admin/setting/'.$img->logo);

            if(file_exists($image_path))
            {
                File::delete($image_path);
            }
        }


        if(request()->hasFile('background_login'))
        {
            $file = $request->file('background_login');
            $imageName = $file->getClientOriginalName();
            $file->move(public_path('uploads/admin/setting'), $imageName);
            $data['background_login'] = $imageName;

            $image_path = public_path('uploads/admin/setting/'.$img->background_login);

            if(file_exists($image_path))
            {
                File::delete($image_path);
            }
        }


        SettingAdmin::find($id)->update($data);
        alert()->success(trans('admin.update'), "Done");
        return back();
    }



}

?>

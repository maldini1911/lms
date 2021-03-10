<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\University;
use SweetAlert;

class Faculties extends BackEndController
{

    public function __construct(Faculty $model)
    {
        parent::__construct($model);
        //$this->middleware(['role:manger']);
    }


    protected function relations_create_edit()
    {
        return ['universities' => University::get()];
    }

  public function store(Request $request)
  {
        $data = $this->validate(request(), [
            'name'             => 'required|string',
            'university_id'    => 'required',
        ]);

        $this->model::create($data);
        alert()->success(trans('admin.success'), 'Done');
        return redirect()->route('faculties.index');
  }

  public function update($id)
  {
      $data = $this->validate(request(), [
          'name'             => 'required|string',
          'university_id'    => 'required',
      ]);

        $this->model->findOrfail($id)->update($data);
        alert()->success(trans('admin.update'), 'Done');
        return redirect()->route('faculties.edit', ['id' => $id]);
    }

}

?>

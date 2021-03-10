<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\University;
use SweetAlert;

class Universities extends BackEndController
{

    public function __construct(University $model)
    {
        parent::__construct($model);
        //$this->middleware(['role:manger']);
    }

  public function store(Request $request)
  {
        $data = $this->validate(request(), [
            'name'   => 'required|string',
        ]);

        $this->model::create($data);
        alert()->success(trans('admin.success'), 'Done');
        return redirect()->route('universities.index');
  }

  public function update($id)
  {
        $data = $this->validate(request(), [
            'name'    => 'required|string',
        ]);

        $this->model->findOrfail($id)->update($data);
        alert()->success(trans('admin.update'), 'Done');
        return redirect()->route('universities.edit', ['id' => $id]);
    }

}

?>

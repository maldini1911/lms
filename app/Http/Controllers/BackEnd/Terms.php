<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Term;
use SweetAlert;

class Terms extends BackEndController
{

  public function __construct(Term $model)
    {
        parent::__construct($model);
        //$this->middleware(['role:manger']);
    }


    protected function relations_create_edit()
    {
        return ['faculties' => Faculty::get()];
    }

  public function store(Request $request)
  {

        $data = $this->validate(request(), [
            'academic_year'     => 'required',
            'term'              => 'required',
            'faculty_id'        => 'required',
        ]);

        
        $terms = $request->term;
        foreach ($terms as $term)
        {
          $data['term'] = $term;
          $this->model::create($data);
        }

        alert()->success(trans('admin.success'), 'Done');
        return redirect()->route('terms.index');
  }

  public function update($id)
  {
        $data = $this->validate(request(), [
            'academic_year'     => 'required',
            'term'              => 'required',
            'faculty_id'        => 'required',
        ]);

        $this->model->findOrfail($id)->update($data);
        alert()->success(trans('admin.update'), 'Done');
        return redirect()->route('terms.edit', ['id' => $id]);
    }

}

?>

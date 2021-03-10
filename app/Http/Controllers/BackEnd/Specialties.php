<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Term;
use App\Models\Specialty;
use App\Models\DepardmentTerm;
use SweetAlert;


class Specialties extends BackEndController
{

  public function __construct(Specialty $model)
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
            'name'              => 'required|string',
            'faculty_id'        => 'required',
            'years'             => 'required'
        ]);

      
        $this->model::insertGetId($data);

        alert()->success(trans('admin.success'), 'Done');
        return redirect()->route('specialties.index');
  }

  public function update(Request $request, $id)
  {
    $data = $this->validate(request(), [
        'name'              => 'required|string',
        'faculty_id'        => 'required',
        'years'             => 'required'
    ]);

        $this->model->where('id', $id)->update($data);

        if($request->has('term_id'))
        {
          $terms = $request->term_id;
          foreach($terms as $term)
          {
              DepardmentTerm::create([
                'specialty_id'  => $id,
                'term_id'       => $term
              ]);
          }
        }

        alert()->success(trans('admin.update'), 'Done');
        return redirect()->route('specialties.edit', ['id' => $id]);
    }


    public function show_department($id)
    {
      $row = Specialty::where("id", $id)->first();
      return view('Admin.specialties.show', compact('row'));
    }

}

?>

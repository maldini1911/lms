<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Specialty;
use App\Models\Term;
use SweetAlert;

class Courses extends BackEndController
{

  public function __construct(Course $model)
    {
        parent::__construct($model);
        //$this->middleware(['role:manger']);
    }

    public function show($id)
    {

        $row = $this->model::where('id', $id)->first();
        return view('Admin.courses.show', compact('row'));
        //$this->middleware(['role:manger']);
    }

    protected function relations_create_edit()
    {
        return ['specialties' => Specialty::get()];
    }

  public function store(Request $request)
  {
        $data = $this->validate(request(), [
            'name'                        => 'required|string',
            'type'                        => 'required|string',
            'specialty_id'                => 'required',
            'applied_hour'                => 'sometimes|nullable',
            'theory_hour'                 => 'sometimes|nullable',
            'squad_id'                    => 'required',
            'term_id'                     => 'sometimes|nullable',
            'course_goals'                => 'sometimes|nullable',
            'information_concepts'        => 'sometimes|nullable',
            'skills_professional'         => 'sometimes|nullable',
            'skills_mindset'              => 'sometimes|nullable',
            'skills_public'               => 'sometimes|nullable',
        ]);

        $theory_hour = $request->theory_hour;
        $applied_hour = $request->applied_hour;
        $course_hour = (int) ($theory_hour + $applied_hour);
        $data['course_hour'] = $course_hour;

        $this->model::create($data);
        alert()->success(trans('admin.success'), 'Done');
        return redirect()->route('courses.index');
  }

  public function update(Request $request, $id)
  {
      $data = $this->validate(request(), [
          'name'                    => 'required|string',
          'type'                    => 'required|string',
          'specialty_id'            => 'required',
          'applied_hour'            => 'sometimes|nullable',
          'theory_hour'             => 'sometimes|nullable',
          'squad_id'                => 'sometimes|nullable',
          'term_id'                 => 'sometimes|nullable',
          'course_goals'            => 'sometimes|nullable',
          'information_concepts'    => 'sometimes|nullable',
          'skills_professional'     => 'sometimes|nullable',
          'skills_mindset'          => 'sometimes|nullable',
          'skills_public'           => 'sometimes|nullable',
      ]);

        $theory_hour = $request->theory_hour;
        $applied_hour = $request->applied_hour;
        $course_hour = (int) ($theory_hour + $applied_hour);
        $data['course_hour'] = $course_hour;
        $this->model->findOrfail($id)->update($data);

        alert()->success(trans('admin.update'), 'Done');
        return redirect()->route('courses.edit', ['id' => $id]);
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


    public function filter_squads($id)
    {
        $department = Specialty::where('id', $id)->first();
        $years = $department->years;

        $squads = Term::take($years)->groupBy('academic_year')->get();
        $data = "";
        $data .=  "<option> Choise Squad </option>";
        foreach($squads as $squad)
        {

            if($squad['academic_year'] == 1)
            {
              $if_year = "One Year";
            }elseif($squad['academic_year'] == 2){
                $if_year = "Second Year";
            }elseif($squad['academic_year'] == 3){
                $if_year = "Three Year";
            }elseif($squad['academic_year'] == 4){
                $if_year = "Four Year";
            }
            $data .=  "<option value='". $squad['academic_year'] . "'>" . $if_year . "</option>";

        }

        return response()->json(['success' => 'success', 'data' => $data]);
    }


    public function filter_terms($id)
    {

        $terms = Term::where('academic_year', $id)->get();

        $data = "";
        $data .=  "<option> Choise Term </option>";
        foreach($terms as $term)
        {
            if($term['term'] == 1)
            {
              $if_term = "One Term";

            }elseif($term['term'] == 2){

              $if_term = "Second Term";
            }
            $data .=  "<option value='". $term['term'] . "'>" . $if_term . "</option>";
        }

        return response()->json(['success' => 'success', 'data' => $data]);
    }


}

?>

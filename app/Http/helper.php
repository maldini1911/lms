<?php
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if(!function_exists('validate_image'))
{
    function validate_image($ext = null)
    {
        if($ext == null)
        {
            return "sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp,svg";
        }else{
            return 'sometimes|nullable|image|mimes:' . $ext;
        }
    }
}


if(!function_exists('Up')){

    function Up(){
        return new \App\Http\Controllers\BackEnd\Upload;
    }
}

if(!function_exists('filter_squad')){

    function filter_squad()
    {
      return [
        'terms'         => App\Models\Term::groupBy('academic_year')->get(),
        'faculties'     => App\Models\Faculty::get(),
        'keys'          => App\Models\Term::get(),
      ];
    }
}

if(!function_exists('show_squads')){

    function show_squads($id)
    {

      $terms = App\Models\Term::where('faculty_id', $id)->groupBy('academic_year')->get();
      $keys = App\Models\Term::where('faculty_id', $id)->get();
      $data = "";

      foreach($terms as $term)
      {
          if($term['academic_year'] == 1)
          {
            $if_year = "First Year";
          }elseif($term['academic_year'] == 2){
              $if_year = "Secont Year";
          }elseif($term['academic_year'] == 3){
              $if_year = "Three Year";
          }elseif($term['academic_year'] == 4){
              $if_year = "Foure Year";
          }
          $data .=  "<optgroup label='".$if_year."'></optgroup>";
          foreach($keys->where('academic_year', $term->academic_year) as $value)
          {
            $if_term = $value['term'] == 1 ? 'First Term' : 'Secont Term';
            $data .=  "<option value='". $value['id'] . "'>" . $if_term . "</option>";
          }

      }

      return $data;
    }
}

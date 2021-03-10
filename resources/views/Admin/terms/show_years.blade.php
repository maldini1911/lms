@if($row->academic_year == 1)
   {{trans('admin.one_year')}}
@elseif($row->academic_year == 2)
   {{trans('admin.two_year')}}
@elseif($row->academic_year == 3)
   {{trans('admin.three_year')}}
@elseif($row->academic_year == 4)
   {{trans('admin.foure_year')}}
@endif

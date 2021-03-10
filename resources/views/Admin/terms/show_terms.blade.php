@if($row->term == 1)
   {{trans('admin.one_term')}}
@elseif($row->term == 2)
   {{trans('admin.two_term')}}
@endif

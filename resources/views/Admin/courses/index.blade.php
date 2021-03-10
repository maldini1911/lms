@extends('Admin.index')

@section('title-page') <i class="fas fa-books"></i> All Courses @endsection

@section('content')

@component('Admin.shared.table', ['titlePage' => $titlePage, 'routeName' => $routeName])
@include("Admin.shared.delete_all")

<div class="table-responsive">

  <!-- Start Delete All -->
  <form action="{{url('admin/subjects/delete/all')}}" method="post" id="form_delete">
      {!! csrf_field() !!}
      <input type="hidden" name="_method" value="DELETE">
  <!-- End Delete All -->

    <table id="example1" class="table table-bordered table-striped text-center">
      <thead>
          <tr>
            <th><input type="checkbox" class="check_all" onclick="check_all()"></th>
              <th>ID</th>
              <th>{{trans('admin.name')}}</th>
              <th>{{trans('admin.type')}}</th>
              <th>{{trans('admin.department')}}</th>
              <th>{{trans('admin.academic_year')}}</th>
              <th>{{trans('admin.term')}}</th>
              <th>Faculty</th>
              <th>Control</th>
          </tr>
      </thead>
      <tbody>
          @foreach($rows as $row)
          <tr>
             <td> @include('Admin.shared.buttons.checkbox') </td>
              <td>{{$row->id}}</td>
              <td>{{$row['name']}}</td>
              <td>{{$row['type']}}</td>
              <td>{{$row->specialty_id ? $row->specialty['name'] : 'Null'}}</td>
              <td>
                  @if($row->squad['academic_year'] == 1)
                      {{trans('admin.one_year') }}
                  @elseif($row->squad['academic_year'] == 2)
                    {{trans('admin.two_year')}}
                  @elseif($row->squad['academic_year'] == 3)
                    {{trans('admin.three_year')}}
                  @elseif($row->squad['academic_year'] == 4)
                    {{trans('admin.four_year')}}
                  @elseif($row->squad['academic_year'] == 5)
                    {{trans('admin.five_year')}}
                  @endif
              </td>
              <td>
                  @if($row->term_id == Null)
                      All Year
                  @else
                    @if($row->term['term'] == 1)
                         - {{trans('admin.one_term')}}
                    @elseif($row->term['term']  == 2)
                          {{trans('admin.two_term')}}
                    @endif
                  @endif
              </td>
              <td> {{$row->specialty->faculty['name']}}</td>
              <td style="display:flex">
                <a href='{{url('admin/subjects/show/'.$row->id)}}' class="btn btn-info"> {{trans("admin.show")}}</a>
                  @include('Admin.shared.buttons.edit')
                  @include('Admin.shared.buttons.delete')
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
  </form>
</div>
{!! $rows->links() !!}

@endcomponent

@endsection
